<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categories() {
    	return $this->belongsToMany('App\Models\Category');
    }

    public function ingredients() {
    	return $this->belongsToMany('App\Models\Ingredient')->withPivot('weight');	
    }

    public function left_label() {
    	return $this->belongsTo('App\Models\Label','left_label_id');
    }

    public function right_label() {
    	return $this->belongsTo('App\Models\Label','right_label_id');
    }

    public function weight () {
        return $this->ingredients->map(function ($item) {
                return $item->pivot->weight;
            })->sum();
    }

    public function carbs () {
        if ($this->weight() > 0) {
            $carbs = $this->ingredients->map(function ($item) {
                    return $item->pivot->weight*$item->carbs/100;
                })->sum();
            return 100*$carbs/$this->weight();
        }
    }

    public function kcal () {
        if ($this->weight() > 0) {
            $kcal = $this->ingredients->map(function ($item) {
                    return $item->pivot->weight*$item->kcal/100;
                })->sum();
            return 100*$kcal/$this->weight();
        }
    }

    public function proteins () {
        if ($this->weight() > 0) {
            $proteins = $this->ingredients->map(function ($item) {
                    return $item->pivot->weight*$item->proteins/100;
                })->sum();
            return 100*$proteins/$this->weight();
        }
    }

    public function fats () {
        if ($this->weight() > 0) {
            $fats = $this->ingredients->map(function ($item) {
                    return $item->pivot->weight*$item->fats/100;
                })->sum();
            return 100*$fats/$this->weight();
        }
    }
}
