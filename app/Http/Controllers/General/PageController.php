<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function index($slug) {
    	if ($slug=='contacts')
    		return view('general.pages.contacts');
    	
        return view('general.article.show',[
            'article' => Page::where('slug', $slug)->first(),
        ]);
    }
}
