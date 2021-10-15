<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    public function view() {
        $data = Category::all();
        $productSale = Product::all()->take(4);
        $products = Product::paginate(6);
        $amount = Product::all()->count();
        return view('shop', compact('data', 'productSale', 'products', 'amount'));
    }
}
