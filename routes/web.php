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


Route::get('/', 'HomepageController@view');

Route::get('/shop', 'ShopController@view');

Route::get('/shop-cart', 'ShoppingCartController@view');

Route::get('/checkout', 'CheckOutController@view');

Route::get('/contact', 'ContactController@view');

Route::get('/blog', 'BlogController@view');

Route::get('/category', 'CategoryController@view');

Route::get('/category/{category_id}', 'CategoryController@detail');

Route::get('/product/{id}', 'ProductController@view');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('admin', 'adminController@adminDashboard');
});

Route::get('/admin', 'AdminController@SignIn');
Route::post('/admin', 'AdminController@getSignIn')->name('getSignIn');

