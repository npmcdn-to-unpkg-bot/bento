<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class ReviewController extends Controller
{
    public function create(){
    	return view('general.review.create');
    }

    public function store(Request $request){
    	auth()->user()->reviews()->create([
    		'text' => $request->text,
    		'published' => 0
    	]);
    	return redirect('account');
    }
}
