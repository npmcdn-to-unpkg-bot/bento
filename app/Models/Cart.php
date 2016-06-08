<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class Cart extends Model
{
	protected $fillable = [
		'hash'
	];

	public static function cart() {


		$hash = request()->cookie('cart');

		$user = auth()->user();

		$cart_from_hash = $hash ? self::where('hash', $hash)->first() : false;

		$cart_from_user = $user ? $user->cart : false;

		if (!$user)
			return $cart_from_hash;

		if ($cart_from_hash==$cart_from_user
			||!$cart_from_hash
			||!$cart_from_hash->products->first() )
			return $cart_from_user;

		if ($cart_from_user){
			$cart_from_user->products()->sync([]);
		 	$cart_from_user->delete();
		}

		$cart_from_hash->user_id = $user->id;
		$cart_from_hash->hash = '';
		$cart_from_hash->save();
		return $cart_from_hash;

	}

	public static function init() {

		$hash = request()->cookie('cart') ? request()->cookie('cart') : str_random(20);

		$cart = new self;
		
		if (auth()->user()){
			$cart->user_id = auth()->user()->id;
		}else{
			$cart->hash = $hash;
		}

		$cart->save();

		return $cart;
	}

	public function sum() {
		return $this->products->map(function($product){
			return $product->new_price()*$product->pivot->quantity;
		})->sum();
	}

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function products() {
    	return $this->belongsToMany('App\Models\Product')->withPivot('quantity');
    }
}
