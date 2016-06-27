<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;
use SoapClient;

class Order extends Model
{

	protected $fillable = [
		'place',
		'phone',
		'persons',
		'time',
		'comment',
		'payment_method'
	];

	public function products(){
		return $this->belongsToMany('App\Models\Product')->withPivot('quantity','price');
	}

	public function sum() {
        return $this->products->map(function($product){
            return $product->pivot->price*$product->pivot->quantity;
        })->sum();
	}

    public function delivery(){
        return $this->sum() >= Setting::get('free_delivery_order_sum') 
            ? 0 
            : Setting::get('delivery_price');
    }

    public function total() {
        return $this->sum() + $this->delivery();
    }

    public function gift() {
    	return Gift::orderBy('start','desc')
    		->where('start','<=',$this->sum())
    		->first();
    }

    public function updateStatus($newStatus) {

        if ($this->status == $newStatus) 
            return false;

        if ($newStatus == 'Принят')
            $this->sms('Ваш заказ #'.$this->id.' принят');

        if ($newStatus == 'Приготовлен')
            $this->sms('Ваш заказ #'.$this->id.' приготовлен');

        if ($newStatus == 'В пути')
            $this->sms('Ваш заказ #'.$this->id.' в пути');

        if ($newStatus == 'Доставлен') {
            if ($this->payment_method == 'Наличными при получении')
                $this->moneyPay();

            if ($this->payment_method == 'Онлайн оплата visa/mastercard')
                $this->moneyPay();

            if ($this->payment_method == 'С бонусного счета')
                $this->bonusPay();

            self::where('id',$this->id)->update(['status' => $newStatus]);
        }

    }

    public function sms($text){
        $client = new SoapClient('http://turbosms.in.ua/api/wsdl.html');
        echo "<pre>";
        print_r(
            $client->Auth([
                'login' => env('SMS_USERNAME'),
                'password' => env('SMS_PASSWORD')
            ])
        );

        print_r(
            $client->SendSMS([
                'sender' => 'bento',
                'destination' => $this->phone,
                'text' => $text
            ])
        );
        die();
    }

    public function moneyPay(){

        if ($this->payed == 'Оплачен') 
            return false;

        $this
            ->user()
            ->increment('bonus_account', $this->sum()/Setting::get('earn_points') );
        self::where('id',$this->id)->update(['payed' => 'Оплачен']);
    }

    public function bonusPay(){

        if ($this->payed == 'Оплачен') 
            return false;

        $this
            ->user()
            ->decrement('bonus_account', $this->sum()/Setting::get('spend_points') );
        self::where('id',$this->id)->update(['payed' => 'Оплачен']);
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

	public function count() {
		return $this->products()->sum('order_product.quantity');
	}

}
