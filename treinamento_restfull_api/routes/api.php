<?php

//use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::group(['prefix' => 'users'], function() {Buyer
//    Route::get('/', 'User\UserController@index');
//    Route::post('/', 'User\UserController@store');
//});

Route::resource('buyers', "Buyer\BuyerController", ['only' => ['index', 'show']]);
Route::resource('categories', "Category\CategoryController", ['except' => ['create', 'edit']]);
Route::resource('sellers', "Seller\SellerController", ['only' => ['index', 'show']]);
Route::resource('transactions', "Transaction\TransactionController");
Route::resource('users', "User\UserController", ['except' => ['create', 'edit']]);
Route::resource('product', "Product\ProductController", ['only' => ['index', 'show']]);
