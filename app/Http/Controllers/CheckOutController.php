<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CheckOutController extends Controller
{
    public function view() {
        $data = Category::all();
        $cart = session()->all();
        return view('checkout', compact('data', 'cart'));
    }
    public function checkout(Request $request) {
        $input = $request->all();
        $cart = session()->all();
        dd($input, $cart);
    }
}
