<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class AdminController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            return view('admin.dashboard', compact('name'));
        }
    }

    public function product()
    {
        if (Auth::check()) {
            $data = Product::paginate(5);
            $name = Auth::user()->name;
            return view('admin.product', compact('name', 'data'));
        }else {
            return redirect()->intended('admin');
        }
    }

    public function editProduct($id)
    {
        if (Auth::check()) {
            $pEdit = Product::where('product_id', $id)->first();

            return view('admin.product.edit', compact('pEdit'));
        }else {
            return redirect()->intended('admin');
        }
    }
    public function updateProduct($id, Request $request)
    {
        if (Auth::check()) {
            $newData = [
                'product_name' => $request->name,
                'price' => $request->price,
                'available' => $request->available,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'gender' => $request->gender,
                'status' => $request->status,
                'image' => $request->image
            ];

            Product::where('product_id', $id)
                ->update($newData);

            return redirect()->intended('admin/product');
        }else {
            return redirect()->intended('admin');
        }
    }

    public function viewInsertP() {
        if(Auth::check()) {
            return view('admin.product.insert');
        }else {
            return redirect()->intended('admin');
        }
    }

    public function insertProduct(Request $request)
    {
        if (Auth::check()) {
            $newData = new Product();
            $newData->product_name = $request->name;
            $newData->price = $request->price;
            $newData->available = $request->available;
            $newData->description = $request->description;
            $newData->category_id = $request->category_id;
            $newData->gender = $request->gender;
            $newData->status = $request->status;
            $newData->image = $request->image;

            $newData->save();

            return redirect()->intended('admin/product');
        }else {
            return redirect()->intended('admin');
        }
    }

    public function deleteProduct($id) 
    {
        if(Auth::check()) {
            Product::where('product_id', $id)
                    ->delete();    
            
            return redirect()->intended('admin/product');
        }else {
            return redirect()->intended('admin');
        }
        
    }
}
