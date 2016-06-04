<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    public function fast(Request $request) {
    	$this->validate($request,[
    		'phone'=>'required'
		]);

    	$order = new Order;
    	$order->phone = $request->phone;
    	$order->first_name = $request->first_name;
    	$order->save();
    	$order->products()->sync(Cart::cart()->products);
    	Cart::cart()->delete();

		return response()->json(['modal'=>'Ваш заказ принят']);
    }
}
