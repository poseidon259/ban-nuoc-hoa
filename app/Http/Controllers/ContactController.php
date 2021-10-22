<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class ContactController extends Controller
{
    public function view() {
        $data = Category::all();

        $dataCart = session()->all();
        $count = -3;
        foreach($dataCart as $index => $product) {
            $count++;
        }

        return view('contact', compact('data', 'count'));
    }
}
