<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Cart;
class ShoppingCartController extends Controller
{
    public function view() {
        $data = Category::all();
        $cart = Cart::all();
        $addedToCart = session()->get('cart');
       
        // dd($addedToCart);
        return view('shop-cart', compact('data', 'cart', 'addedToCart'));
    }
}
