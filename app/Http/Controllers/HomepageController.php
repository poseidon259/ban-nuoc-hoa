<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomepageController extends Controller
{
    public function view() {
        $data = Category::all();
        $productForMan = Product::all()->where('gender', 1)->take(4);    
        $productForWoman = Product::all()->where('gender', 0)->take(4);
        $noibat = Product::all()->where('status', 'noibat');     
        $banchay = Product::all()->where('status', 'banchay'); 
        return view('homepage', compact('data', 'productForMan', 'productForWoman', 'noibat', 'banchay'));
    }
}
