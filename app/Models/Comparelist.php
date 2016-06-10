<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comparelist extends Model
{
	protected $fillable = [ 'hash' ];

	public static function get() {

		$hash = request()->cookie('laravel_session');

		$user = auth()->user();

		$comparelist_from_hash = $hash ? self::where('hash', $hash)->first() : false;

		$comparelist_from_user = $user ? $user->comparelist : false;

		if (!$user)
			return $comparelist_from_hash;

		if ($comparelist_from_hash==$comparelist_from_user
			||!$comparelist_from_hash
			||!$comparelist_from_hash->products->first() )
			return $comparelist_from_user;

		if ($comparelist_from_user){
			$comparelist_from_user->products()->sync([]);
		 	$comparelist_from_user->delete();
		}

		$comparelist_from_hash->user_id = $user->id;
		$comparelist_from_hash->hash = '';
		$comparelist_from_hash->save();
		return $comparelist_from_hash;

	}

	public static function init() {

		$comparelist = new self;
		
		if (auth()->user())
			$comparelist->user_id = auth()->user()->id;
		else
			$comparelist->hash = request()->cookie('laravel_session');
		
		$comparelist->save();

		return $comparelist;
	}

	public function products () {
		return $this->belongsToMany('App\Models\Product');
	}
}
