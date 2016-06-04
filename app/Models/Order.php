<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products() {
    	return $this->belongsToMany('App\Models\Product');
    }

    public function user() {
    	return $this->belnogsTo('App\User');
    }
}
