<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CheckOutController extends Controller
{
    public function view() {
        $data = Category::all();

        $dataCart = session()->all();
        $count = -3;
        foreach($dataCart as $index => $product) {
            $count++;
        }

        return view('checkout', compact('data', 'count'));
    }
}
