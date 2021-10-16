<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
class BlogController extends Controller
{
    public function view() {
        $data = Category::all();
        $blog = DB::table('blog')->get();
        return view('blog', compact('data', 'blog'));
    }

    public function detail($id) {
        $data = Category::all();
        $blog = DB::table('blog')
        ->where('blog_id', $id)
        ->get();
        return view('blogdetail', compact('blog', 'data'));
    }
}
