<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function view() {
        $data = Category::all();
        return view('product', compact('data'));
    }
}
