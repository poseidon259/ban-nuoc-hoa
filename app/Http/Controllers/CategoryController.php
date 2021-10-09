<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Category;
class CategoryController extends Controller
{
    public function view() {
        $data = Category::all();
        return view('category', compact('data'));
    }

    public function detail($category_id) {   
        $title = Category::where('category_id', $category_id)->first();
        return view('category', compact('title'));
    }
}
