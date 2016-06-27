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

	public function add($id) {

		$cart = Cart::get() ? Cart::get() : Cart::init();
	
		if ($product = $cart->products()->find($id)) {
			$product->pivot->quantity++;
			$product->pivot->save();
		}else{
			$cart->products()->attach($id,['quantity'=>1]);
		}

		session()->forget('deleted_from_cart');
	
		return back();
	}

	public function update(Request $request) {
		if ($product = Cart::get()->products()->find($request->id)) {
			$product->pivot->quantity=$request->quantity > 0 ? $request->quantity : 1;
			$product->pivot->save();
		}
		return response(200);
	}

	public function delete($id) {
		Cart::get()
			->products()
			->detach($id);

		session()->put('deleted_from_cart',$id);

		return back();
	}
}
