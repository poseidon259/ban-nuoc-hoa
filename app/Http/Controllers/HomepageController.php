<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomepageController extends Controller
{
    public function view() {
        $data = Category::all();
        return view('homepage', compact('data'));
    }
}
