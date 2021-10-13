<?php

use Illuminate\Support\Facades\Route;




Route::get('/', 'HomepageController@view');

Route::get('/shop', 'ShopController@view');

Route::get('/shop-cart', 'ShoppingCartController@view');

Route::get('/checkout', 'CheckOutController@view');

Route::get('/contact', 'ContactController@view');

Route::get('/blog', 'BlogController@view');

Route::get('/category', 'CategoryController@view');

Route::get('/category/{category_id}', 'CategoryController@detail');

Route::get('/product/{id}', 'ProductController@view');

Route::get('/register', 'RegisterController@view');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('admin', 'AdminController@view');
});



