<?php

use App\Http\Controllers\CategoryController;
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
    return view('homepage');
});

Route::get('/shop', function () {
    return view('shop');
});

Route::get('/shop-cart', function () {
    return view('shop-cart');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/checkout', function() {
    return view('checkout');
});

Route::get('/category/{id}', 'CategoryController@view');

//Test routes
Route::get('/test', 'TestController@index');
Route::get('/test/{id}', 'TestController@view');
