<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function view()
    {
        $data = Category::all();
        $productSale = Product::where('sale', '<>', 0)->get();
        $products = Product::where('sale', 0)->paginate(6);
        $amount = Product::all()->count();

        return view('shop', compact('data', 'productSale', 'products', 'amount') );
    }
}
