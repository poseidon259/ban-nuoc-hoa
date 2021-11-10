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
Route::post('/checkout', 'CheckOutController@view');
Route::get('/checkout/process', 'CheckOutController@checkout')->name('processCheckout');
Route::post('/checkout/process', 'CheckOutController@checkout');

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
Route::get('/admin/user/delete/{id}', 'AdminController@deleteUser')->name('deleteUser');

Route::get('/admin/input', 'AdminController@input')->name('input');
Route::get('/admin/input/insert', 'AdminController@viewInsertInput')->name('insertInput');
Route::post('/admin/input/insert', 'AdminController@insertInput');
Route::get('/admin/input/edit/{id}', 'AdminController@viewEditInput')->name('editInput');
Route::post('/admin/input/edit/{id}', 'AdminController@updateInput');
Route::get('/admin/input/delete/{id}', 'AdminController@deleteInput')->name('deleteInput');


Route::get('/admin/inputDetail', 'AdminController@inputDetail')->name('inputDetail');
Route::get('/admin/inputDetail/insert', 'AdminController@viewInsertInputDetail')->name('insertInputDetail');
Route::post('/admin/inputDetail/insert', 'AdminController@insertInputDetail');
Route::get('/admin/inputDetail/edit/{id}/{pid}', 'AdminController@viewEditInputDetail')->name('editInputDetail');
Route::post('/admin/inputDetail/edit/{id}/{pid}', 'AdminController@updateInputDetail');
Route::get('/admin/inputDetail/delete/{id}/{pid}', 'AdminController@deleteInputDetail')->name('deleteInputDetail');


Route::get('/admin/order', 'AdminController@order')->name('order');
Route::get('/admin/order/insert', 'AdminController@viewInsertOrder')->name('insertOrder');
Route::post('/admin/order/insert', 'AdminController@insertOrder');
Route::get('/admin/order/edit/{id}', 'AdminController@viewEditOrder')->name('editOrder');
Route::post('/admin/order/edit/{id}', 'AdminController@updateOrder');
Route::get('/admin/order/delete/{id}', 'AdminController@deleteOrder')->name('deleteOrder');

Route::get('/admin/orderDetail', 'AdminController@orderDetail')->name('orderDetail');
Route::get('/admin/orderDetail/insert', 'AdminController@viewInsertOrderDetail')->name('insertOrderDetail');
Route::post('/admin/orderDetail/insert', 'AdminController@insertOrderDetail');
Route::get('/admin/orderDetail/edit/{id}/{pid}', 'AdminController@viewEditOrderDetail')->name('editOrderDetail');
Route::post('/admin/orderDetail/edit/{id}/{pid}', 'AdminController@updateOrderDetail');
Route::get('/admin/orderDetail/delete/{id}/{pid}', 'AdminController@deleteOrderDetail')->name('deleteOrderDetail');


Route::get('/admin/order/sendmail/{id}', 'AdminController@sendMail')->name('sendMail');


