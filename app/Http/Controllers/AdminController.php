<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;


class AdminController extends Controller
{
    //
    public function SignIn() {
        return view('admin.signin');
    }

    public function getSignIn(Request $request) {
        $input = Account::where('email', $request->email)->where('password', $request->pwd)->get();
        if(count($input) != 0) {
            return view('admin.dashboard');
        }
        return view('admin.signin');
    }
}
