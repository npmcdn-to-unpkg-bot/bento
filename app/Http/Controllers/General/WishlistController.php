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


	public function toggle(Request $request) {

		$wishlist = Wishlist::get() ? Wishlist::get() : Wishlist::init();

		if ($wishlist->products()->where('id',$request->id)->first())
			$wishlist->products()->detach($request->id);
		else
			$wishlist->products()->attach($request->id);
	
		return response(200);
	}

}
