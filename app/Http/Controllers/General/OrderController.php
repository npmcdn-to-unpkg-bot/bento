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
            'place'=>'required',
            'phone'=>'required'
        ]);
        
        $user = auth()->user();
        $order = $user->orders()->create([]);

        $place = $user->places()->firstOrCreate(['text'=>$request->place]);
        $order->place = $request->place;

        if ($user->phone!=$request->phone)
            $phone = $user->phones()->firstOrCreate(['text'=>$request->phone]);
        $order->phone = $request->phone;
        
        $order->persons = $request->persons;
        $order->time = $request->time;
        $order->comment = $request->comment;
        $order->first_name = $user->first_name;
        $order->save();
        $order->products()->sync(
            Cart::get()->products->keyBy('id')->map(function($product){
                return ['quantity'=>$product->pivot->quantity];
            })->all()
        );
        Cart::get()->delete();    

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
            Cart::get()->products->keyBy('id')->map(function($product){
                return ['quantity'=>$product->pivot->quantity];
            })->all()
        );
        Cart::get()->delete();

        return response()->json(['modal'=>'Ваш заказ принят']);
    }

}
