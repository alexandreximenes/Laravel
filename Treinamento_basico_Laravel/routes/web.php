<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ProdutoController@lista');
Route::get('/json', 'ProdutoController@listaJson');

//Route::get('/produtos', 'ProdutoController@lista');
Route::get('/produto/detalhe/{id}', 'ProdutoController@detalhe');
Route::get('/produto/detalhe/json/{id}', 'ProdutoController@detalheJson');
Route::get('/produto/novo', 'ProdutoController@novo');
Route::post('/produto/adicionar', 'ProdutoController@adicionar');
Route::get('/produto/delete/{id}', 'ProdutoController@delete');

Route::get('/form-login', 'LoginController@form');
Route::post('login', 'LoginController@login');


//Route::get('/', function () {
//    return view('welcome');
//});