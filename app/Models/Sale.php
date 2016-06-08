<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;

class Sale extends Model
{

	use OrderableModel;
	
    public function products() {
    	return $this->belongsToMany('App\Models\Product');
    }

    public function users() {
    	return $this->belongsToMany('App\User');
    }

    public function getOrderField()
    {
        return 'order';
    }
}
