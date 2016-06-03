<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{

	protected $fillable = [
		'name', 'text'
	];

	public $timestamps = false;

    public function user () {
    	return $this->belongsTo('App\User');
    }
}
