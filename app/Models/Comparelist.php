<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comparelist extends Model
{
	protected $fillable = [ 'hash' ];

	public static function get() {

		if (auth()->user())
			return auth()->user()->comparelist;
		else
			return self::where('hash', request()->cookie('laravel_session'))->first();

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

	public static function has($product) {
		if ($comparelist = self::get())
			return $comparelist->products()->where('id', $product->id)->first();
		return false;
	}

	public function products () {
		return $this->belongsToMany('App\Models\Product');
	}
}
