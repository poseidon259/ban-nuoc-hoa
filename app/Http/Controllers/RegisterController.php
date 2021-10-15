<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
class RegisterController extends Controller
{
    public function create() {
        return view('admin.register');
    }

    public function store(Request $request) {

        $item = [
            'account_name'=> $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phonenumber' => $request->phonenumber,
            'address' => $request->address
        ];
        Account::insert($item);
        return Redirect()->route('login');
    }
}
