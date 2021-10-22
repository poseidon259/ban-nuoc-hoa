<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function view($id) {
        $data = Category::all();
        $product_byID = Product::all()->where('product_id', $id)->first();
        //dd($product_byID);

        $dataCart = session()->all();
        $count = -3;
        foreach($dataCart as $index => $product) {
            $count++;
        }

        return view('product', compact('data', 'product_byID', 'count'));
    }

    
}
