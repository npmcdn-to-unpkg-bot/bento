<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\Setting;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->first();
        
        if ($category) {

            $ingredients = Ingredient::find( Setting::get('ingredient_filters') );
        
            $ingredients_checked = array_filter ( explode(',', $request->ingredients ) );
            
            $products = $category->products();

            $max_possible = $products->max('price');
            $min_possible = $products->min('price');

            if ($request->min)
                $products->where('price','>=',$request->min);

            if ($request->max)
                $products->where('price','<=',$request->max);

            foreach ($ingredients_checked as $id)
                $products->whereHas('ingredients',function($query)use($id){
                    $query->where('id', $id);
                });

            $products = $products->get();

            return view('general.product.index',[
                'products' => $products,
                'max' => $request->max ? $request->max : $max_possible,
                'min' => $request->min ? $request->min : $min_possible,
                'max_possible' => $max_possible,
                'min_possible' => $min_possible,
                'category' => $category,
                'ingredients' => $ingredients,
                'ingredients_checked' => $ingredients_checked
            ]);
        }else{
            return $this->show($slug);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('general.product.show',[
            'product'=>$product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function vote($id, $value, Request $request){
        $vote = auth()
            ->user()
            ->votes()
            ->firstOrNew(['product_id'=>$id]);
        $vote->value = $value;
        $vote->save();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'width' => Product::find($id)->votes->avg('value')/5*100
            ]);
        } else {
            $product = Product::find($id);
            return redirect('menu/'.$product->slug);
        }
    }
}
