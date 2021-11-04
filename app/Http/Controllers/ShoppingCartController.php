<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Product;
class ShoppingCartController extends Controller
{

    public function view() {
        $data = Category::all();
        $cart = session()->all();
        return view('shop-cart', compact('data', 'cart'));
    }

    public function handle($id) {
        $item = Product::where('product_id', $id)->first();
        session()->put($id, $item);

        return redirect()->intended('/shop-cart');
    }

    public function getData() {
        $data = session()->all();
        dd($data);
    }
    
    public function deleteData() {
        session()->flush();
    }

    public function deleteDataByID($id) {
        $data = session()->all();
        unset($data[$id]);

        session()->flush();
        foreach($data as $index => $product) {
            session()->put($index, $product);
        }

        return redirect()->intended('/shop-cart');
    }
}
