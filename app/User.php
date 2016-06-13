<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'trafic_source', 'bento_card', 'birth_day', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function places () {
        return $this->hasMany('App\Models\Place');
    }

    public function cart () {
        return $this->hasOne('App\Models\Cart');
    }

    public function wishlist () {
        return $this->hasOne('App\Models\Wishlist');
    }

    public function comparelist () {
        return $this->hasOne('App\Models\Comparelist');
    }

    public function orders () {
        return $this->hasMany('App\Models\Order');
    }

    public function sales () {
        return $this->belongsToMany('App\Models\Sale');
    }

    public function phones () {
        return $this->hasMany('App\Models\Phone');
    }
}
