<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class BlogController extends Controller
{
    public function view() {
        $data = Category::all();
        return view('blog', compact('data'));
    }
}

