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


Route::get('/', 'HomepageController@view')->name('home');

Route::get('/shop', 'ShopController@view')->name('shop');

Route::get('/shop-cart', 'ShoppingCartController@view')->name('shop-cart');

Route::get('/checkout', 'CheckOutController@view')->name('checkout');

Route::get('/contact', 'ContactController@view')->name('contact');

Route::get('/blog', 'BlogController@view')->name('blog');

Route::get('/category/{category_id}', 'CategoryController@detail');

Route::get('/product/{id}', 'ProductController@view');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('admin', 'adminController@adminDashboard');
});

Route::get('/admin', 'AdminController@SignIn');
Route::post('/admin', 'AdminController@getSignIn')->name('getSignIn');

