<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return 'welcome';
});

Route::get('fit/{width}/{height}',        'General\ImageController@fit');
Route::get('resize/{width}/{height}',     'General\ImageController@resize');
Route::get('width/{width}',               'General\ImageController@width');
Route::get('height/{height}',             'General\ImageController@height');
Route::get('greyscale',                   'General\ImageController@greyscale');

Route::auth();

Route::get('/',                           'General\HomeController@index');
Route::get('menu/{slug}',                 'General\ProductController@index');
Route::get('news/{slug?}',                'General\NewsController@index');
Route::get('blog/{slug?}',                'General\BlogController@index');
Route::get('search',                      'General\SearchController@index');

Route::get('cart/index',                  'General\CartController@index');
Route::post('cart/add',                   'General\CartController@add');
Route::post('cart/update',                'General\CartController@update');
Route::post('cart/delete',                'General\CartController@delete');

Route::get('wishlist',                    'General\WishlistController@index');
Route::post('wishlist/add',               'General\WishlistController@add');
Route::post('wishlist/delete',            'General\WishlistController@delete');

Route::get('comparelist',                 'General\ComparelistController@index');
Route::post('comparelist/add',            'General\ComparelistController@add');
Route::post('comparelist/delete',         'General\ComparelistController@delete');

Route::post('order/fast',                 'General\OrderController@fast');

Route::group(['middleware'=>'auth'],function(){
	Route::get('checkout',                'General\OrderController@index');
	Route::post('checkout',               'General\OrderController@full');
});