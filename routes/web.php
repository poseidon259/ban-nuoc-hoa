<?php

use Illuminate\Support\Facades\Route;




Route::get('/', 'HomepageController@view')->name('home');

Route::get('/shop', 'ShopController@view')->name('shop');

Route::get('/shop-cart', 'ShoppingCartController@view')->name('shop-cart');
Route::get('/shop-cart/{id}', 'ShoppingCartController@handle')->name('handleCart');
Route::get('/session/getData', 'ShoppingCartController@getData');
Route::get('/session/deleteData', 'ShoppingCartController@deleteData');
Route::get('/delete-cart/{id}', 'ShoppingCartController@deleteDataByID')->name('deleteCart');

Route::get('/checkout', 'CheckOutController@view')->name('checkout');

Route::get('/contact', 'ContactController@view')->name('contact');

Route::get('/blog', 'BlogController@view')->name('blog');

Route::get('/blog/{id}', 'BlogController@detail')->name('blogdetail');

Route::get('/category/{id}', 'CategoryController@detail')->name('category');

Route::get('/product/{id}', 'ProductController@view')->name('product');

//Route::get('shop/add-to-cart/{id}', 'ShopController@addToCart')->name('addToCart');

//Route::get('shop-cart/{id}', 'ShopController@deleteCart')->name('deleteCart');

// Route::get('/admin/register', 'RegisterController@create')->name('register');
// Route::post('/admin/register', 'RegisterController@store');

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

Route::get('/admin/blog', 'AdminController@blog')->name('adminBlog');
Route::get('/admin/blog/edit/{id}', 'AdminController@editBlog')->name('editBlog');
Route::post('/admin/blog/edit/{id}', 'AdminController@updateBlog');
Route::get('/admin/blog/insert', 'AdminController@viewInsertBlog')->name('insertBlog');
Route::post('/admin/blog/insert', 'AdminController@insertBlog');
Route::get('/admin/blog/delete/{id}', 'AdminController@deleteBlog')->name('deleteBlog');


Route::get('/admin/category', 'AdminController@category')->name('adminCategory');
Route::get('/admin/category/edit/{id}', 'AdminController@editCategory')->name('editCategory');
Route::post('/admin/category/edit/{id}', 'AdminController@updateCategory');
Route::get('/admin/category/insert', 'AdminController@viewInsertCategory')->name('insertCategory');
Route::post('/admin/category/insert', 'AdminController@insertCategory');
Route::get('/admin/category/delete/{id}', 'AdminController@deleteCategory')->name('deleteCategory');


Route::get('/admin/user', 'AdminController@user')->name('user');
Route::get('/admin/user/insert', 'AdminController@viewInsertUser')->name('insertUser');
Route::post('/admin/user/insert', 'AdminController@insertUser');
Route::get('/admin/user/edit/{id}', 'AdminController@editUser')->name('editUser');
Route::post('/admin/user/edit/{id}', 'AdminController@updateUser');
Route::get('/admin/category/user/{id}', 'AdminController@deleteUser')->name('deleteUser');





