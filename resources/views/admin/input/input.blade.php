@extends('admin.site')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Phiếu nhập</h1>

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
                            <th>Mã phiếu nhập</th>
                            <th>Tên nhân viên</th>
                            <th>Địa chỉ nơi nhập</th>
                            <th>Ngày nhập</th>
                            <th colspan="2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->emp_name}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->created_at}}</td>
                            <td><a class="btn btn-primary btn-sm text-white" href="{{route('editInput', ['id' => $item->id])}}">Edit</a></td>
                            <td><a class="btn btn-danger btn-sm text-white" href="{{route('deleteInput', ['id' => $item->id])}}" onClick="return confirm('Nếu bạn xóa phiếu nhập này, tất cả sản phẩm nhập cũng bị xóa !!')">Delete</a></td>
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