<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\Cart;
use App\Models\Order;
use App\User;

class OrderController extends Controller
{
    public function index() {
        return view('general.checkout.index');
    }

    public function full(Request $request) {

        if ($user = auth()->user()){
            $this->validate($request,[
                'place'=>'required|max:255',
                'phone'=>'required|max:255',
                'payment_method'=>'required'
            ]);
            
            $place = $user->places()->firstOrCreate(['text'=>$request->place]);
            if ($user->phone!=$request->phone)
                $phone = $user->phones()->firstOrCreate(['text'=>$request->phone]);

        }else{
            $this->validate($request,[
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'phone' => 'required|max:255',
                'place' => 'required|max:255',
                'phone'=>'required|max:255',
                'payment_method'=>'required',
            ]);

            $user = User::create([
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'password' => bcrypt($request->password)
            ]);

            $user->places()->create([
                'name' => 'Основной адрес',
                'text' => $request->place
            ]);


        }

        Cart::get()->checkout($request, $user);

        auth()->login($user);

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
