<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    protected $table = 'users';
    public function index() {
        return redirect()->route('login');
    }
    public function form() {
        return view('admin.login');
    }

    public function login(Request $request) {
        $arr = [
            'name' => $request->name,
            'password' => $request->password
        ];

		if(Auth::attempt($arr)) {
			// Kiểm tra đúng email và mật khẩu sẽ chuyển trang
            return redirect()->intended('admin/dashboard')->with('success', 'Đăng nhập thành công');
		} else {
			// Kiểm tra không đúng ko cho đăng nhập
            return redirect()->intended('admin/login')->with('error', 'Đăng nhập không thành công');
		}
    }


   public function logout() {
       Auth::logout();
       return redirect()->intended('admin/login');
   }
}
