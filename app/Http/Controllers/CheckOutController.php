<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;


class CheckOutController extends Controller
{
    public function view(Request $request)
    {
        $data = Category::all();
        $cart = session()->all();
        $count = 0;
        foreach ($cart as $key => $value) {
            if(is_numeric($key)) $count++;
        }

        if($count > 0) {
            $quantity = $request->all();
            foreach ($cart as $key => $value) {
                if (is_numeric($key)) {
                    foreach ($quantity as $key2 => $value2) {
                        if ($key == $key2 && is_numeric($key2)) {
                            $value['quantity'] = intval($value2);
                            session()->put($key, $value);
                        }
                    }
                }
            }
            $cart = session()->all();
            return view('checkout', compact('data', 'cart'));
        } else {
            return redirect()->route('home')->with('alert', 'Giỏ hàng chưa có sản phẩm nào !');
        }
    } 
    public function checkout(Request $request)
    {
        
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required'
        ], [
            'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
            'email' => 'Email không hợp lệ',
            'numeric' => 'Số điện thoại phải là số'
        ]);

        $newOrder = new Order();
        $newOrder->firstname = $request->firstname;
        $newOrder->lastname = $request->lastname;
        $newOrder->email = $request->email;
        $newOrder->address = $request->address;
        $newOrder->phone = $request->phone;
        $newOrder->created_at = date('Y-m-d');
        $newOrder->note = $request->note;
        $newOrder->save();

        $dataProducts = session()->all();
        foreach ($dataProducts as $key => $value) {
            if (is_numeric($key)) {
                $dataCheck = Product::where('product_id', $value['product_id'])->first();
                if($dataCheck->quantity < $value['quantity']){
                    Order::where('id', $newOrder->id)->delete();
                    return redirect()->intended('/checkout')->with('error', 'Số lượng sản phẩm '. $dataCheck->product_name .' trong kho là '. $dataCheck->quantity .', không đủ để đặt hàng');
                } else {
                    $newOrderDetail = new OrderDetail();
                    $newOrderDetail->order_id = $newOrder->id;
                    $newOrderDetail->product_id = $value['product_id'];
                    $newOrderDetail->quantity = $value['quantity'];
                    $newOrderDetail->price = $value['price'] - ($value['price'] * $value['sale']);
                    $newOrderDetail->save();
                }               
            }
        }

        return redirect()->intended('/')->with('alert', 'Đặt hàng thành công, mã đơn hàng của bạn là '. $newOrder->id);
    }
}
