<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class RegisterController extends Controller
{
    public function create() {
        return view('admin.register');
    }

    public function store(Request $request) {

        $item = [
            'name'=> $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];
        User::insert($item);
        return Redirect()->route('login');
    }
}
