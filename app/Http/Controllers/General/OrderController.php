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

        if ($user = auth()->user()){
            $this->validate($request,[
                'place'=>'required',
                'phone'=>'required',
                'payment'=>'required'
            ]);
            
            $place = $user->places()->firstOrCreate(['text'=>$request->place]);
            if ($user->phone!=$request->phone)
                $phone = $user->phones()->firstOrCreate(['text'=>$request->phone]);


            Cart::get()->checkout($request);

        }else{
            $this->validate($request,[
                'place'=>'required',
                'phone'=>'required',
                'payment'=>'required'
            ]);
        }

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
