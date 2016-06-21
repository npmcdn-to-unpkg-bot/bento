<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
	protected $fillable = ['product_id'];
	
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function product(){
    	return $this->belongsTo('App\Models\Product');
    }
}
