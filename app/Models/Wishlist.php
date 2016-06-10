<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{

	protected $fillable = [ 'hash' ];

	public static function get() {

		$hash = request()->cookie('laravel_session');

		$user = auth()->user();

		$wishlist_from_hash = $hash ? self::where('hash', $hash)->first() : false;

		$wishlist_from_user = $user ? $user->wishlist : false;

		if (!$user)
			return $wishlist_from_hash;

		if ($wishlist_from_hash==$wishlist_from_user
			||!$wishlist_from_hash
			||!$wishlist_from_hash->products->first() )
			return $wishlist_from_user;

		if ($wishlist_from_user){
			$wishlist_from_user->products()->sync([]);
		 	$wishlist_from_user->delete();
		}

		$wishlist_from_hash->user_id = $user->id;
		$wishlist_from_hash->hash = '';
		$wishlist_from_hash->save();
		return $wishlist_from_hash;

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

	public function products () {
		return $this->belongsToMany('App\Models\Product','wishlist_product');
	}

}
