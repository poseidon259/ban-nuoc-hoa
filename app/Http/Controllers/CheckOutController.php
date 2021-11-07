<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CheckOutController extends Controller
{
    public function view(Request $request) {
        $data = Category::all();
        $cart = session()->all();
        $quantity = $request->all();
        foreach ($cart as $key => $value) {
            if(is_numeric($key)) {
                $cart[$key]['quantity'] = $quantity[$key];
            }
        }

        session()->flush();
        foreach ($cart as $key => $value) {
            session()->put($key, $value);
        }
        return view('checkout', compact('data', 'cart'));
    }
    public function checkout(Request $request) {
        //dd($request->all());
        //dd(session()->all());
        
    }
}
