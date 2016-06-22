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

Route::get ('fit/{width}/{height}',        'General\ImageController@fit');
Route::get ('resize/{width}/{height}',     'General\ImageController@resize');
Route::get ('width/{width}',               'General\ImageController@width');
Route::get ('height/{height}',             'General\ImageController@height');
Route::get ('greyscale',                   'General\ImageController@greyscale');

Route::auth();

Route::get ('/',                           'General\HomeController@index');
Route::get ('menu/{slug}',                 'General\ProductController@index');
Route::get ('news/{slug?}',                'General\NewsController@index');
Route::get ('blog/{slug?}',                'General\BlogController@index');
Route::get ('search',                      'General\SearchController@index');

Route::get ('cart',                        'General\CartController@block');
Route::get ('cart/table',                  'General\CartController@table');
Route::post('cart/add',                    'General\CartController@add');
Route::post('cart/update',                 'General\CartController@update');
Route::post('cart/delete',                 'General\CartController@delete');
Route::get ('checkout',                    'General\CartController@index');
Route::post('checkout',                    'General\OrderController@full');


Route::get ('wishlist',                    'General\WishlistController@index');
Route::post('wishlist/toggle',             'General\WishlistController@toggle');

Route::get ('comparelist',                 'General\ComparelistController@index');
Route::post('comparelist/toggle',          'General\ComparelistController@toggle');

Route::post('order/fast',                  'General\OrderController@fast');

Route::group(['middleware'=>'auth'],function(){
	Route::get ('product/{id}/vote/{value}',  'General\ProductController@vote');
	Route::get ('account',                    'General\AccountController@index');
	Route::post('account',                    'General\AccountController@store');
	Route::get ('account/edit',               'General\AccountController@edit');
	Route::get ('account/order/{id}',         'General\AccountController@order');
	Route::get ('pay/{id}',                   'General\OrderController@pay');
});

Route::get ('{slug}',                      'General\PageController@index');
