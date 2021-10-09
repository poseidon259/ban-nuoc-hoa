<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class ShoppingCartController extends Controller
{
    public function view() {
        $data = Category::all();
        return view('shop-cart', compact('data'));
    }
}
