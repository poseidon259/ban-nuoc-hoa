<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function index() {
        return view('admin.sign-in');
    }

    public function handleRequest(Request $request) {
        return $request->all();
    }
}
