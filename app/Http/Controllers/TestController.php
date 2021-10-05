<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function index() {
        return view('Test.index');
    }

    // /test/1
    public function view($id) {
        $data = Test::all();
        return view('Test.view', compact('data'));
    }
}
