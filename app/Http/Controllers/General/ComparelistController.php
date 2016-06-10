<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Comparelist;

class ComparelistController extends Controller
{

    public function index() {
    	return view('general.comparelist.modal');
    }

	public function add(Request $request) {

		$comparelist = Comparelist::get() ? Comparelist::get() : Comparelist::init();
	
		$comparelist->products()->detach($request->id);

		$comparelist->products()->attach($request->id);
	
		return response(200);
	}

	public function delete(Request $request) {
		Comparelist::get()
			->products()
			->detach($request->id);
		return response(200);
	}
}
