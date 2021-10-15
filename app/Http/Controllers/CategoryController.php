<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function view($id) {
        return view('category');
    }

    public function detail($category_id) {  
        $data = Category::all(); 
        $title = Category::where('category_id', $category_id)->first();
        $product = DB::table('category')
                    ->join('product', 'product.category_id', '=', 'category.category_id')
                    ->where('product.category_id', '=', $category_id)
                    ->get();
        // dd($product);
        return view('categorydetail', compact('data', 'title','product'));
    }
}
