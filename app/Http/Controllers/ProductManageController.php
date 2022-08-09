<?php

namespace App\Http\Controllers;

use App\Models\InputDetail;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = Product::paginate(10);
        $name = Auth::user()->name;

        foreach ($data as $key => $value) {
            $soLuongNhap = InputDetail::where('product_id', $value->product_id)->sum('quantity');
            $soLuongNhap = is_null($soLuongNhap) ? 0 : $soLuongNhap;
            $soLuongXuat = OrderDetail::where('product_id', $value->product_id)->sum('quantity');
            $soLuongXuat = is_null($soLuongXuat) ? 0 : $soLuongXuat;

            $quantity = is_null($soLuongNhap - $soLuongXuat) ? 0 : $soLuongNhap - $soLuongXuat;
            $value->quantity = $quantity;
            $value->save();
        }
        return view('admin.product.product', compact('name', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
