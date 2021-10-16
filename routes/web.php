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

Route::get('shop/add-to-cart/{id}', 'ShopController@addToCart')->name('addToCart');

Route::get('/admin/register', 'RegisterController@create')->name('register');
Route::post('/admin/register', 'RegisterController@store');

Route::get('/admin', 'LoginController@index');
Route::get('/admin/login', 'LoginController@form')->name('login')->middleware('isAdmin');
Route::post('/admin/login', 'LoginController@login');
Route::get('/admin/logout', 'LoginController@logout')->name('logout');

Route::get('/admin/dashboard', 'AdminController@index')->name('dashboard')->middleware('checkLogout');




