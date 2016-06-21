<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;
use Storage;
use App\Models\Order;

class AccountController extends Controller
{
    public function index() {
    	return view('general.account.index');
    }

    public function edit() {
    	return view('general.account.edit');	
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'first_name' => 'required|max:255',
    		'last_name' => 'required|max:255',
    		'phone' => 'required|max:255',
    		'place' => 'required|max:255'
    	]);

        if ($request->hasFile('upload')) {
        	Storage::delete( public_path(auth()->user()->image) );
            $extension = $request->file('upload')->getClientOriginalExtension();
            $name = $request->file('upload')->getClientOriginalName();
            $name = str_slug( str_replace ( $extension, '', $name ) );
            $image = 'files/uploads/' . time() . '-' . $name . '.' . $extension;
            Image::make($request->file('upload'))
                ->resize(1600, 1024, function ($constraint) { $constraint->upsize(); })
                ->save(public_path($image));
            $request->merge(['image' => $image]);
        }

    	auth()
    		->user()
    		->fill( $request->only('first_name','last_name','phone','place','image') )
    		->save();

        auth()
            ->user()
            ->places()
            ->whereNotIn('id', array_keys((array)$request->places['name']) )
            ->delete();

        foreach ((array)$request->places['name'] as $id => $name) {
            $place = auth()->user()->places()->where('id', $id)->first();
            $place = $place ? $place : auth()->user()->places()->create([]);
            $place->name = $request->places['name'][$id];
            $place->text = $request->places['text'][$id];
            $place->save();
        }

        auth()
            ->user()
            ->phones()
            ->whereNotIn('id', array_keys((array)$request->phones['name']) )
            ->delete();

        foreach ((array)$request->phones['name'] as $id => $name) {
            $phone = auth()->user()->phones()->where('id', $id)->first();
            $phone = $phone ? $phone : auth()->user()->phones()->create([]);
            $phone->name = $request->phones['name'][$id];
            $phone->text = $request->phones['text'][$id];
            $phone->save();
        }

    	return redirect('account');
    }

    public function order($id) {
        return view('general.account.order.show', ['order' => Order::find($id)]);
    }
}
