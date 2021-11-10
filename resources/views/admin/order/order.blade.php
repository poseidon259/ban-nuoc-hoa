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
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ghi chú</th>
                            <th>Ngày tạo</th>
                            <th>Xác nhận</th>
                            <th>Trạng thái</th>
                            <th colspan="2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->firstname}} {{$item->lastname}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->note}}</td>
                            <td>{{$item->created_at}}</td>
                            @if($item->status == false)
                            <td><a class="btn btn-primary btn-sm text-white" href="{{route('sendMail', ['id' => $item->id])}}">Gửi</a></td>
                            @else
                            <td><a class="btn btn-secondary btn-sm text-white" href="#" >Đã gửi</a></td>
                            @endif
                            @if($item->status == false)
                            <td>Chưa xác nhận</td>
                            @else
                            <td>Đã xác nhận</td>
                            @endif
                            <td><a class="btn btn-primary btn-sm text-white" href="{{route('editInput', ['id' => $item->id])}}">Edit</a></td>
                            <td><a class="btn btn-danger btn-sm text-white" href="{{route('deleteInput', ['id' => $item->id])}}" onClick="return confirm('Nếu bạn xóa hóa đơn này, tất cả sản phẩm trong hóa đơn cũng bị xóa !!')">Delete</a></td>
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