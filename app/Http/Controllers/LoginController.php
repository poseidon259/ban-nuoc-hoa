<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function __construct()
    {
        @session_start();
    }

    public function form() {
        return view('login');
    }

    public function login(Request $request) {
        $email = $request->input('email');
		$password = $request->input('password');
        $auth = DB::table('account')->where('email', $email)->where('password', $password);
		if($auth) {
			// Kiểm tra đúng email và mật khẩu sẽ chuyển trang
            
			return redirect('/');
		} else {
			// Kiểm tra không đúng sẽ hiển thị thông báo lỗi
			$request->session()->flash('error', 'Email hoặc mật khẩu không đúng!');
			return redirect('login');
		}
    }

   
}
