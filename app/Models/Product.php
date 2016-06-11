<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use Carbon\Carbon;
use DB;

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
            return ceil(100*$carbs/$this->weight());
        }
    }

    public function kcal () {
        if ($this->weight() > 0) {
            $kcal = $this->ingredients->map(function ($item) {
                    return $item->pivot->weight*$item->kcal/100;
                })->sum();
            return ceil(100*$kcal/$this->weight());
        }
    }

    public function proteins () {
        if ($this->weight() > 0) {
            $proteins = $this->ingredients->map(function ($item) {
                    return $item->pivot->weight*$item->proteins/100;
                })->sum();
            return ceil(100*$proteins/$this->weight());
        }
    }

    public function fats () {
        if ($this->weight() > 0) {
            $fats = $this->ingredients->map(function ($item) {
                    return $item->pivot->weight*$item->fats/100;
                })->sum();
            return ceil(100*$fats/$this->weight());
        }
    }

    public function url () {
        return url('menu/'.$this->slug);
    }

    public function sales () {
        return $this->belongsToMany('App\Models\Sale');
    }
 
    public function actual_sales_query() {
        $product = $this;
        return Sale::orderBy('order')
            ->where(function ($query) use ($product) {
                $query
                    ->whereDoesntHave('products')
                    ->orWhereHas('products',function ($query) use ($product) {
                        $query->where('id',$product->id);
                    });
            })
            ->where(function ($query) {
                $query->whereDoesntHave('users');
                if ( auth()->id() )
                    $query->orWhereHas('users', function ($query) {
                        $query->where( 'id', auth()->id() );
                    });
            })
            ->where(function ($query) {
                $query
                    ->orWhereRaw('start < end AND  CURTIME() > start AND CURTIME() < end')
                    ->orWhereRaw('start > end AND (CURTIME() > start OR  CURTIME() < end)')
                    ->orWhereRaw('start = end');
            });
    }

    public function unstackable_sales() {
        return $this->actual_sales_query()->whereRaw('stackable = 0')->take(1)->get();
    }

    public function stackable_sales() {
        return $this->actual_sales_query()->whereRaw('stackable = 1')->get();
    }

    public function actual_sales() {
        $unstackable_sales = $this->actual_sales_query()->whereRaw('stackable = 0')->take(1)->get();
        if ( $unstackable_sales->first() )
            return $unstackable_sales;
        $stackable_sales = $this->actual_sales_query()->whereRaw('stackable = 1')->get();
            return $stackable_sales;
    }

    public function new_price() {
        $sales = $this->actual_sales();
        $price = $this->price;
        foreach ($sales as $sale)
            $price = $price * (1 - $sale->value / 100);
        return ceil($price);
    }

}
