<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Cart
{

	protected $fillable = [
		'place',
		'phone',
		'persons',
		'time',
		'comment',
		'payment_method'
	];

	public static function get() {
		//
	}

	public static function init() {
		//
	}

    public function user() {
    	return $this->belongsTo('App\User');
    }

	public function count() {
		return $this->products()->sum('order_product.quantity');
	}

}
