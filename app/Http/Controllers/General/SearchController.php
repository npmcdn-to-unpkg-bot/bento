<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Search;

class SearchController extends Controller
{
    public function index(Request $request) {
    	$products = Product::where('name','LIKE','%'.$request->q.'%')
    		->orWhere('description', 'LIKE', '%'.$request->q.'%')
    		->orderBy('order')
    		->orderBy('created_at')
    		->get();

    	Search::firstOrCreate([
    		'q'    => $request->q,
    		'ip'   => $request->ip()
    	]);
    	
    	return view('general.search.index',[
    		'products' => $products
    	]);
    }
}
