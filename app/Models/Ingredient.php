<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public $timestamps = false;

    public function products() {
    	return $this->belongsToMany('App\Models\Product')->withPivot('weight');
    }
}
