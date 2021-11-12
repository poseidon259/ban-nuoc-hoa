<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;

class CheckOrderController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('order.checkOrder', compact('data'));
    }

    public function process(Request $request)
    {
        $check = Order::where('id', $request->id)->count();
        $data = Category::all();
        if($check > 0) {
            $order = Order::where('id', $request->id)->first();
            $order_detail = OrderDetail::where('order_id', $request->id)
                            ->join('product', 'order_detail.product_id', '=', 'product.product_id')
                            ->select('order_detail.*', 'product.product_name', 'product.image')
                            ->get();
            
            return view('order.orderdetail', compact('data', 'order', 'order_detail'));
        } else {
            return redirect()->intended('/checkorder')->with('error', 'Mã hóa đơn không tồn tại !');
        }
    }
}
