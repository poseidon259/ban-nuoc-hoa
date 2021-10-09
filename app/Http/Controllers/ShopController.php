<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ShopController extends Controller
{
    public function view() {
        $data = Category::all();
        return view('shop', compact('data'));
    }
}
