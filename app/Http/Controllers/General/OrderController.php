<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Setting;
use App\User;
use App\Http\Controllers\Payment;

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
            
            if ($user->place!=$request->place)
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
                'place' => $request->place,
                'phone' => $request->phone,
                'password' => bcrypt($request->password)
            ]);


        }

        $order = Cart::get()->checkout($request, $user);

        auth()->login($user);

        if ($order->payment_method == 'С бонусного счета') {
            if ($user->bonus_account*Setting::get('spend_points') < $order->sum()) {
                $order->payment_method = 'Наличными при получении';
            }else{
                $order->bonusPay();
            }
        }

        if ($order->payment_method == 'Онлайн оплата visa/mastercard')
            return redirect('pay/'.$order->id);

        return redirect('account');

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

    public function pay($id) {

        $order = auth()->user()->orders()->find($id);

        if (!$order||$order->payed=="Оплачен")
            abort(404);

        return view('general.checkout.redirect', [
            'order' => $order,
            'payment' => Payment::newInstance()
        ]);
    }

    public function store(Request $request) {

        $signature = base64_encode( sha1( 
            env("LIQPAY_PRIVAT_KEY") .  
            $request->data . 
            env("LIQPAY_PRIVAT_KEY")
            , 1 ));

        if ($request->signature == $signature) {
            $data = json_decode ( base64_decode ($request->data) );
            $order = Order::find($data->order_id);
            $order->liqpay_status = $data->status;
            $order->liqpay_response = base64_decode ($request->data);

            if ($data->status=='sandbox') {
                $order->payment_method = 'Онлайн оплата visa/mastercard';
                $order->payed = 'Оплачен';
            }else{
                $order->payed = 'Ожидает оплаты';
            }
            
            $order->save();
            return redirect('account');
        }
        
        abort(404);
    }

}
