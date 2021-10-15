<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    protected $table = 'account';
    public function index() {
        return redirect()->route('login');
    }
    public function form() {
        return view('admin.login');
    }

    public function login(Request $request) {
        $arr = [
            'email' => $request->email,
            'password' => $request->password
        ];

		if(Auth::attempt($arr)) {
			// Kiểm tra đúng email và mật khẩu sẽ chuyển trang
            return redirect()->intended('admin/dashboard');
		} else {
			// Kiểm tra không đúng ko cho đăng nhập
            return redirect()->intended('admin/login');
		}
    }

   public function logout() {
       Auth::logout();
       return redirect()->intended('admin/login');
   }
}
