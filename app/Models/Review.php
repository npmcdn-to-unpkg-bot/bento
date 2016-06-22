<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $fillable = ['text'];
	
    public function user() {
    	return $this->belongsTo('App\User');
    }
}
