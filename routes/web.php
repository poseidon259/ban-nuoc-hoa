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
Route::get('/admin/product', 'AdminController@product')->name('adminProduct');
Route::get('/admin/product/edit/{id}', 'AdminController@editProduct')->name('editProduct');
Route::post('/admin/product/edit/{id}', 'AdminController@updateProduct');

Route::get('/admin/product/insert', 'AdminController@viewInsertP')->name('insertProduct');
Route::post('/admin/product/insert', 'AdminController@insertProduct');
Route::get('/admin/product/delete/{id}', 'AdminController@deleteProduct')->name('deleteProduct');

Route::get('/admin/blog', 'AdminController@product')->name('adminBlog');
Route::get('/admin/category', 'AdminController@product')->name('adminCategory');





