<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;

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
        $sum = $this->products->map(function($product){
            return $product->pivot->price*$product->pivot->quantity;
        })->sum();

        $delivery = $sum >= Setting::get('free_delivery_order_sum') 
            ? 0 
            : Setting::get('delivery_price');
            
        return $sum + $delivery;
	}

    public function delivery(){
        $sum = $this->products->map(function($product){
            return $product->pivot->price*$product->pivot->quantity;
        })->sum();

        $delivery = $sum >= Setting::get('free_delivery_order_sum') 
            ? 0 
            : Setting::get('delivery_price');
            
        return $delivery;
    }

    public function gift() {
    	return Gift::where('start','<=',$this->sum())
    		->orderBy('start','desc')
    		->first();
    }

    public function updateStatus($newStatus) {

        if ($this->status == $newStatus) 
            return false;

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
