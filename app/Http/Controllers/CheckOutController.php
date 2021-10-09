<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CheckOutController extends Controller
{
    public function view() {
        $data = Category::all();
        return view('checkout', compact('data'));
    }
}
