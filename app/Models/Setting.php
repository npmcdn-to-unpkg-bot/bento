<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

	protected $fillable = ['name','value'];

	public $timestamps = false;
	
    public static function getModel($name) {
    	$setting = self::firstOrNew(['name'=>$name]);
    	$setting->$name = json_decode($setting->value) ? json_decode($setting->value) : $setting->value;
    	return $setting;
    }

    public static function get($name) {
    	return self::getModel($name)->$name;
    }
}
