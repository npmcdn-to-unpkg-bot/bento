<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;

class WishlistController extends Controller
{

    public function index() {
    	return view('general.wishlist.modal');
    }

	public function add(Request $request) {

		$wishlist = Wishlist::get() ? Wishlist::get() : Wishlist::init();

		$wishlist->products()->detach($request->id);
	
		$wishlist->products()->attach($request->id);
	
		return response(200);
	}

	public function delete(Request $request) {
		Wishlist::get()
			->products()
			->detach($request->id);
		return response(200);
	}

}
