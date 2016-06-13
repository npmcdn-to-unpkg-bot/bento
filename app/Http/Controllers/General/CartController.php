<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cart;

class CartController extends Controller
{

	public function index() {
		return view('general.checkout.index');
	}

	public function block() {
		return view('general.cart.block');
	}

	public function table() {
		return view('general.cart.table');
	}

	public function add(Request $request) {

		$cart = Cart::get() ? Cart::get() : Cart::init();
	
		if ($product = $cart->products()->find($request->id)) {
			$product->pivot->quantity++;
			$product->pivot->save();
		}else{
			$cart->products()->attach($request->id,['quantity'=>1]);
		}
	
		return response(200);
	}

	public function update(Request $request) {
		if ($product = Cart::get()->products()->find($request->id)) {
			$product->pivot->quantity=$request->value > 0 ? $request->value : 1;
			$product->pivot->save();
		}
		return response(200);
	}

	public function delete(Request $request) {
		Cart::get()
			->products()
			->detach($request->id);
		return response(200);
	}
}
