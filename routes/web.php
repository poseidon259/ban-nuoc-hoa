<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
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



Route::get('/shop', 'ShopController@view');

Route::get('/shop-cart', 'ShoppingCartController@view');

Route::get('/checkout', 'CheckOutController@view');

Route::get('/contact', 'ContactController@view');

Route::get('/blog', 'BlogController@view');

Route::get('/category', 'CategoryController@view');

Route::get('/category/{category_id}', 'CategoryController@detail');

Route::get('/product/{id}', 'ProductController@view');



Route::get('/admin', 'SignInController@index');

Route::get('/', 'HomepageController@view');
