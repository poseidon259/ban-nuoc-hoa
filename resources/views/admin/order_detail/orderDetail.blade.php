@extends('admin.site')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Đơn hàng</h1>

    @if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        <strong>{{Session::get('error')}}</strong>
    </div>
    @endif

    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        <strong>{{Session::get('success')}}</strong>
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4 text-center">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã sản phẩm</th>
                            <th>Số lượng mua</th>
                            <th>Giá</th>
                            <th colspan="2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{$item->order_id}}</td>
                            <td>{{$item->product_id}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price}}</td>
                            <td><a class="btn btn-primary btn-sm text-white" href="{{route('editOrderDetail', ['id' => $item->order_id, 'pid' => $item->product_id])}}">Edit</a></td>
                            <td><a class="btn btn-danger btn-sm text-white" href="{{route('deleteOrderDetail', ['id' => $item->order_id, 'pid' => $item->product_id])}}" onClick="return confirm('Bạn xác nhận muốn xóa sản phẩm có mã {{$item->product_id}} của hóa đơn có mã {{$item->order_id}} !!')">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<div class="">{{$data->links()}}</div>

@stop()