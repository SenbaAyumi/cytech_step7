<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/product_list', 'App\Http\Controllers\CytechController@index')->name('product.list')->middleware('auth');
Route::delete('/product_list/{product}', 'App\Http\Controllers\CytechController@delete')->name('product.delete')->middleware('auth');

Route::get('/product_register', 'App\Http\Controllers\CytechController@create')->name('product.create')->middleware('auth');
Route::post('/post', 'App\Http\Controllers\CytechController@post')->name('product.post')->middleware('auth');

Route::get('/product_information/{product}', 'App\Http\Controllers\CytechController@show')->name('product.show')->middleware('auth');

Route::get('/product_edit/{product}', 'App\Http\Controllers\CytechController@edit')->name('product.edit')->middleware('auth');
Route::put('/product_edit/{product}', 'App\Http\Controllers\CytechController@update')->name('product.update')->middleware('auth');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
