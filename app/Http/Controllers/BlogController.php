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
        $blog = Blog::paginate(4);

        $dataCart = session()->all();
        $count = 0;
        foreach($dataCart as $index => $product) {
            $count++;
        }
        return view('blog', compact('data', 'blog', 'count'));
    }

    public function detail($id) {
        $count = Blog::all()->count();
        $id_rand = rand(0, $count);
        $data = Category::all();
        $blog = DB::table('blog')
        ->where('blog_id', $id)
        ->first();
        $review = Blog::where('blog_id','<>' ,$id_rand)->take(3)->get();

        return view('blogdetail', compact('blog', 'data', 'review'));
    }
}
