<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckOrderController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductManageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;



// trang chủ
Route::get('/', [HomepageController::class, 'view'])->name('home');

// cửa hàng
Route::get('/shop', [ShopController::class, 'view'])->name('shop');

// liên hệ
Route::get('/contact', [ContactController::class, 'view'])->name('contact');

// sản phẩm thuộc danh mục
Route::get('/category/{id}', [CategoryController::class, 'detail'])->name('category');

// chi tiết sản phẩm
Route::get('/product/{id}', [ProductController::class, 'view'])->name('product');

// giỏ hàng
Route::prefix('shopping-cart')->group(function() {
    Route::get('/', [ShoppingCartController::class, 'view'])->name('shopCart');
    Route::get('/{id}', [ShoppingCartController::class, 'handle'])->name('addProductToCart');
    Route::get('/delete-cart/{id}', [ShoppingCartController::class, 'deleteDataById'])->name('deleteCart');
});

// thanh toán
Route::prefix('checkout')->group(function() {
    Route::get('/', [CheckOutController::class, 'view'])->name('checkout');
    Route::post('/', [CheckOutController::class, 'view']);
    Route::get('/process', [CheckOutController::class, 'checkout'])->name('processCheckout');
    Route::post('/process', [CheckOutController::class, 'checkout']);
});

// bài viết
Route::prefix('blog')->group(function() {
    Route::get('/', [BlogController::class, 'view'])->name('blog');
    Route::get('/{id}', [BlogController::class, 'detail'])->name('blogDetail');
});

// kiểm tra đơn hàng
Route::prefix('check-order')->group(function() {
    Route::get('/', [CheckOrderController::class, 'index'])->name('checkOrder');
    Route::post('/', [CheckOrderController::class, 'process']);
});

// quản trị
Route::prefix('admin')->group(function() {
    Route::get('/', [LoginController::class, 'index']);
    Route::get('/login', [LoginController::class, 'form'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('auth')->middleware('checkLogout')->group(function() {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/sendmail/{id}', [AdminController::class, 'sendMail'])->name('sendMail');

        // quản lý sản phẩm
        Route::prefix('product')->group(function() {
            Route::get('/', [AdminController::class, 'product'])->name('adminProduct');
            Route::get('/edit/{id}', [AdminController::class, 'editProduct'])->name('editProduct');
            Route::post('/edit/{id}', [AdminController::class, 'updateProduct']);
            Route::get('/add', [AdminController::class, 'viewInsertProduct'])->name('insertProduct');
            Route::post('/add', [AdminController::class, 'insertProduct']);
            Route::get('/delete/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');
        });

        // quản lý bài viết
        Route::prefix('blog')->group(function() {
            Route::get('/', [AdminController::class, 'blog'])->name('adminBlog');
            Route::get('/edit/{id}', [AdminController::class, 'editBlog'])->name('editBlog');
            Route::post('/edit/{id}', [AdminController::class, 'updateBlog']);
            Route::get('/add', [AdminController::class, 'viewInsertBlog'])->name('insertBlog');
            Route::post('/add', [AdminController::class, 'insertBlog']);
            Route::get('/delete/{id}', [AdminController::class, 'deleteBlog'])->name('deleteBlog');
        });

        // quản lý danh mục
        Route::prefix('category')->group(function() {
            Route::get('/', [AdminController::class, 'category'])->name('adminCategory');
            Route::get('/edit/{id}', [AdminController::class, 'editCategory'])->name('editCategory');
            Route::post('/edit/{id}', [AdminController::class, 'updateCategory']);
            Route::get('/add', [AdminController::class, 'viewInsertCategory'])->name('insertCategory');
            Route::post('/add', [AdminController::class, 'insertCategory']);
            Route::get('/delete/{id}', [AdminController::class, 'deleteCategory'])->name('deleteCategory');
        });

        // quản lý tài khoản
        Route::prefix('user')->group(function() {
            Route::get('/', [AdminController::class, 'user'])->name('user');
            Route::get('/edit/{id}', [AdminController::class, 'editUser'])->name('editUser');
            Route::post('/edit/{id}', [AdminController::class, 'updateUser']);
            Route::get('/add', [AdminController::class, 'viewInsertUser'])->name('insertUser');
            Route::post('/add', [AdminController::class, 'insertUser']);
            Route::get('/delete/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
        });

        // quản lý đơn hàng
        Route::prefix('input')->group(function() {
            Route::get('/', [AdminController::class, 'input'])->name('input');
            Route::get('/edit/{id}', [AdminController::class, 'viewEditInput'])->name('editInput');
            Route::post('/edit/{id}', [AdminController::class, 'updateInput']);
            Route::get('/add', [AdminController::class, 'viewInsertInput'])->name('insertInput');
            Route::post('/add', [AdminController::class, 'insertInput']);
            Route::get('/delete/{id}', [AdminController::class, 'deleteInput'])->name('deleteInput');
        });

        // quản lý chi tiết đơn hàng
        Route::prefix('inputDetail')->group(function() {
            Route::get('/', [AdminController::class, 'inputDetail'])->name('inputDetail');
            Route::get('/edit/{id}', [AdminController::class, 'viewEditInputDetail'])->name('editInputDetail');
            Route::post('/edit/{id}', [AdminController::class, 'updateInputDetail']);
            Route::get('/add', [AdminController::class, 'viewInsertInputDetail'])->name('insertInputDetail');
            Route::post('/add', [AdminController::class, 'insertInputDetail']);
            Route::get('/delete/{id}', [AdminController::class, 'deleteInputDetail'])->name('deleteInputDetail');
        });

        // quản lý hàng nhập
        Route::prefix('order')->group(function() {
            Route::get('/', [AdminController::class, 'order'])->name('order');
            Route::get('/edit/{id}', [AdminController::class, 'viewEditOrder'])->name('editOrder');
            Route::post('/edit/{id}', [AdminController::class, 'updateOrder']);
            Route::get('/add', [AdminController::class, 'viewInsertOrder'])->name('insertOrder');
            Route::post('/add', [AdminController::class, 'insertOrder']);
            Route::get('/delete/{id}', [AdminController::class, 'deleteOrder'])->name('deleteOrder');
        });

        // quản lý chi tiết hàng nhập
        Route::prefix('orderDetail')->group(function() {
            Route::get('/', [AdminController::class, 'orderDetail'])->name('orderDetail');
            Route::get('/edit/{id}', [AdminController::class, 'viewEditOrderDetail'])->name('insertOrderDetail');
            Route::post('/edit/{id}', [AdminController::class, 'updateOrderDetail']);
            Route::get('/add', [AdminController::class, 'viewInsertOrderDetail'])->name('editOrderDetail');
            Route::post('/add', [AdminController::class, 'insertOrderDetail']);
            Route::get('/delete/{id}', [AdminController::class, 'deleteOrderDetail'])->name('deleteOrderDetail');
        });
    });
});





