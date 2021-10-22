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
        $products = Product::paginate(6);
        $amount = Product::all()->count();

        $dataCart = session()->all();
        $count = -3;
        foreach($dataCart as $index => $product) {
            $count++;
        }


        return view('shop', compact('data', 'productSale', 'products', 'amount', 'count') );
    }

    // public function addToCart($id)
    // {

    //     // session()->flush();
    //     // dd("end");
    //     $product = DB::table('product')
    //         ->where('product_id', $id)
    //         ->get();
    //     // dd($product[0]);

    //     $cart = session()->get('cart');
    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
    //     } else {
    //         $cart[$id] = [
    //             'name' => $product[0]->product_name,
    //             'price' => $product[0]->price,
    //             'quantity' => 1,
    //             'image' => $product[0]->image
    //         ];
    //     }
    //     session()->put('cart', $cart);

    //     echo "<pre>";
    //     return response()->json([
    //         'code' => 200,
    //         'message' => 'sucess'
    //     ]);
    // }

    // public function deleteCart(Request $request) {
    //     $cart = session()->pull('cart', []); 
    //     // dd($request);
    //     // if(($key = array_search($id, $cart)) !== false) {
    //     //     unset($cart[$key]);
    //     // }
        
    //     // session()->put('products', $cart);
    // }
}
