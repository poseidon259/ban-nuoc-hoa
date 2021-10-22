<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
class HomepageController extends Controller
{
    public function view() {
        $data = Category::all();
        $productForMan = Product::all()->where('gender', 1)->take(4);    
        $productForWoman = Product::all()->where('gender', 0)->take(4);
        $blog = Blog::all()->take(3);

        $dataCart = session()->all();
        $count = -3;
        foreach($dataCart as $index => $product) {
            $count++;
        }
        return view('homepage', compact('data', 'productForMan', 'productForWoman', 'blog', 'count'));
    }
}
