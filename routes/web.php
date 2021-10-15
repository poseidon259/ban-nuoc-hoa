<?php

use Illuminate\Support\Facades\Route;




Route::get('/', 'HomepageController@view')->name('home');

Route::get('/shop', 'ShopController@view')->name('shop');

Route::get('/shop-cart', 'ShoppingCartController@view')->name('shop-cart');

Route::get('/checkout', 'CheckOutController@view')->name('checkout');

Route::get('/contact', 'ContactController@view')->name('contact');

Route::get('/blog', 'BlogController@view')->name('blog');

Route::get('/category/{category_id}', 'CategoryController@detail')->name('category');

Route::get('/product/{id}', 'ProductController@view')->name('product');

Route::get('/register', 'RegisterController@create')->name('register');
Route::post('register', 'RegisterController@store');

Route::get('/login', 'LoginController@form')->name('login');

Route::post('/login', 'LoginController@login');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('admin', 'AdminController@view');
});

Route::get('/admin', 'AdminController@SignIn');
Route::post('/admin', 'AdminController@getSignIn')->name('getSignIn');



