<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class ShoppingCartController extends Controller
{

    public function view(Request $request) {
        $data = Category::all();
        $cart = session()->all();
        return view('shop-cart', compact('data', 'cart'));
    }

    public function handle($id) {
        $data = Product::where('product_id', $id)->first();

        $newData = [
            'product_id' => $data->product_id,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'image' => $data->image,
            'quantity' => 1,
            'description' => $data->description,
            'category_id' => $data->category_id,
            'gender' => $data->gender,
            'sale' => $data->sale
        ];

        session()->put($id, $newData);
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
