<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Category;

class CategoryController extends Controller
{
    public function view($id) {
        return view('category');
    }
}
