<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    public function index() {
        return view('general.checkout.index');
    }

    public function full(Request $request) {
        $this->validate($request,[
            'place'=>'required'
        ]);
        
        $user = auth()->user();

        $place = $user->places()->firstOrCreate(['text'=>$request->place]);

        $order = $user->orders()->create([]);
        $order->place_id = $place->id;
        $order->phone = $user->phone;
        $order->comment = $request->comment;
        $order->first_name = $user->first_name;
        $order->save();
        $order->products()->sync(
            Cart::cart()->products->keyBy('id')->map(function($product){
                return ['quantity'=>$product->pivot->quantity];
            })->all()
        );
        Cart::cart()->delete();    

        return redirect('/');

    }

    public function fast(Request $request) {
        $this->validate($request,[
            'phone'=>'required'
        ]);

        $order = new Order;
        $order->phone = $request->phone;
        $order->first_name = $request->first_name;
        $order->save();
        $order->products()->sync(
            Cart::cart()->products->keyBy('id')->map(function($product){
                return ['quantity'=>$product->pivot->quantity];
            })->all()
        );
        Cart::cart()->delete();

        return response()->json(['modal'=>'Ваш заказ принят']);
    }

}
