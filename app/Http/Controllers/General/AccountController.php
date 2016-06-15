<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;
use Storage;

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
    	return redirect('account');
    }
}
