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
        $productForMan = Product::all()->where('gender', 1)->take(5);
        $productForWoman = Product::all()->where('gender', 0)->take(5);
        $blog = Blog::all()->take(3);

        return view('homepage', compact('data', 'productForMan', 'productForWoman', 'blog'));
    }
}
