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

	public function toggle(Request $request) {

		$comparelist = Comparelist::get() ? Comparelist::get() : Comparelist::init();

		if ($comparelist->products()->where('id',$request->id)->first())
			$comparelist->products()->detach($request->id);
		else
			$comparelist->products()->attach($request->id);
	
		return response(200);
	}

}
