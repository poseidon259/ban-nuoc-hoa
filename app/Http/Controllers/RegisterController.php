<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
class RegisterController extends Controller
{
    public function create() {
        return view('register');
    }

    public function store(Request $request) {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $phonenumber = $request->input('phonenumber');
        $address = $request->input('address');
        
        DB::table('account')->insert([
            'account_name'=> $name,
            'email' => $email,
            'password' => $password,
            'phonenumber' => $phonenumber,
            'address' => $address
        ]);
        
        
        return redirect()->to('/');

    }
}
