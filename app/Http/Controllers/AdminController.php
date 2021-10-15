<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index() {
        return view('admin.dashboard');
    }

}
