<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{

	protected $fillable = [ 'hash' ];

	public static function get() {

		if (auth()->user())
			return auth()->user()->wishlist;
		else
			return self::where('hash', request()->cookie('laravel_session'))->first();

	}

	public static function init() {

		$wishlist = new self;
		
		if (auth()->user())
			$wishlist->user_id = auth()->user()->id;
		else
			$wishlist->hash = request()->cookie('laravel_session');
		
		$wishlist->save();

		return $wishlist;
	}

	public static function has($product) {
		if ($wishlist = self::get())
			return $wishlist->products()->where('id', $product->id)->first();
		return false;
	}

	public function products () {
		return $this->belongsToMany('App\Models\Product','wishlist_product');
	}

}
