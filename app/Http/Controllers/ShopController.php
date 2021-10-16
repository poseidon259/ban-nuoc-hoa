<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class ShopController extends Controller
{
    public function view() {
        $data = Category::all();
        $productSale = Product::all()->take(4);
        $products = Product::paginate(6);
        $amount = Product::all()->count();
        return view('shop', compact('data', 'productSale', 'products', 'amount'));
    }

    public function addToCart($id) {
        
        $cart = array();
        $product = DB::table('product')
                    ->where('product_id', $id)
                    ->get();
        dd($product->product_name);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1; 
        } else {
            $cart[$id] = [
                'name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }
        session()->put('cart', $cart);

        echo "<pre>";
        print_r(session()->get);
    }
}
