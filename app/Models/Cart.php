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

		if (auth()->user()
			&&!auth()->user()->cart()->has('products')
			&&request()->cookie('cart'))
				auth()->user()->cart->delete();

		if (auth()->user())
			return auth()->user()->cart;

		if (request()->cookie('cart'))
			return self::where('hash', request()->cookie('cart'))->first();

		return false;
	}

	public static function init() {

		$hash = request()->cookie('cart') ? request()->cookie('cart') : str_random(20);

		$cart = self::firstOrNew([
			'hash' => $hash
		]);
		
		$cart->user_id = auth()->user() ? auth()->user()->id : 0 ;

		$cart->save();

		return $cart;
	}

	public function sum() {
		return $this->products->map(function($product){return $product->price*$product->pivot->quantity;})->sum();
	}

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function products() {
    	return $this->belongsToMany('App\Models\Product')->withPivot('quantity');
    }
}
