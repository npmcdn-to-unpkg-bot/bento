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

	public function toggle($id) {

		$comparelist = Comparelist::get() ? Comparelist::get() : Comparelist::init();

		if ($comparelist->products()->where('id',$id)->first())
			$comparelist->products()->detach($id);
		else
			$comparelist->products()->attach($id);
	
		return response(200);
	}

}
