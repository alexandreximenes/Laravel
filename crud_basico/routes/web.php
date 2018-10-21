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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/new', 'PagesController@new');

Route::get('/bemvindo', 'BlogController@index');


Route::get('/todos', 'TodoController@index');
Route::get('/todos/delete/{id}', 'TodoController@delete');
Route::post('/todos/create', 'TodoController@create');
Route::post('/todos/save/{id}', 'TodoController@save');
Route::get('/todos/update/{id}', 'TodoController@update');
Route::get('/todos/completed/{id}', 'TodoController@completed');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
