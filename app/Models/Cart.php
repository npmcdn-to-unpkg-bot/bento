<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use App\Models\Setting;

class Cart extends Model
{
	protected $fillable = [ 'hash'	];

	public static function get() {

		if (auth()->user())
			return auth()->user()->cart;
		else
			return self::where('hash', request()->cookie('laravel_session'))->first();

	}

	public static function init() {

		$cart = new self;
		
		if (auth()->user())
			$cart->user_id = auth()->user()->id;
		else
			$cart->hash = request()->cookie('laravel_session');
		
		$cart->save();

		return $cart;
	}

	public static function has($product) {
		if ($cart = self::get())
			return $cart->products()->where('id', $product->id)->first();
		return false;
	}

	public function sum() {

        return $this->products->map(function($product){
            return $product->new_price()*$product->pivot->quantity;
        })->sum();

	}

    public function delivery(){
        return $this->sum() >= Setting::get('free_delivery_order_sum') 
            ? 0 
            : Setting::get('delivery_price');

    }

    public function total(){
        return $this->sum() + $this->delivery();
    }

    public function deleted_product() {
        return Product::find( session('deleted_from_cart') );
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function products() {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity');
    }

    public function gift() {
        return Gift::where('start','<=',$this->sum())
            ->orderBy('start','desc')
            ->first();
    }
    public function next_gift() {
        return Gift::where('start','>',$this->sum())
            ->orderBy('start','asc')
            ->first();
    }


    public function checkout ($data, $user){

    	if (!$user) return false;

        $order = $user->orders()->create([]);

        $order->fill($data->only(
			'place',
			'phone',
			'persons',
			'time',
			'comment',
            'payment_method'
        ));
        $order->first_name = $user->first_name;
        $order->save();
        $order->products()->sync(
            $this->products->keyBy('id')->map(function($product){
                return [
                    'quantity'=>$product->pivot->quantity,
                    'price'=>$product->new_price()
                ];
            })->all()
        );
        $this->products()->sync([]);
        $this->delete();
        return $order;
    }
}
