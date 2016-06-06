<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products() {
    	return $this->belongsToMany('App\Models\Product');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

	public function sum() {
		return $this->products->map(function($product){
			return $product->price*$product->pivot->quantity;
		})->sum();
	}

	public function count() {
		return $this->products()->sum('order_product.quantity');
	}
}
