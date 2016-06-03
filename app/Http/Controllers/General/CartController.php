<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cart;

class CartController extends Controller
{
	public function add(Request $request) {

		$cart = Cart::cart() ? Cart::cart() : Cart::init();
	
		if ($product = $cart->products()->find($request->id)) {
			$product->pivot->quantity++;
			$product->pivot->save();
		}else{
			$cart->products()->attach($request->id,['quantity'=>1]);
		}

		return view('general.carts.cart')->withCookie(cookie()->forever('cart', $cart->hash));
	}

	public function update(Request $request) {
		if ($product = Cart::cart()->products()->find($request->id)) {
			$product->pivot->quantity=$request->value;
			$product->pivot->save();
		}
		return view('general.carts.cart');
	}

	public function delete(Request $request) {
		Cart::cart()
			->products()
			->detach($request->id);
		return view('general.carts.cart');
	}
}
