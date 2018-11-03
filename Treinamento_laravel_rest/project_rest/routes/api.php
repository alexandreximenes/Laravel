<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('buyer', 'Buyer\BuyerController', ['only' => ['index', 'show'] ]);
Route::resource('category', 'Category\CategoryController');
Route::resource('product', 'Product\ProductController');
Route::resource('seller', 'Seller\SellerController');
Route::resource('transaction', 'Transaction\TransactionController');
Route::resource('user', 'UserController');
Route::get('/buyer/{name}', 'Buyer\BuyerController@myMethod');
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});




