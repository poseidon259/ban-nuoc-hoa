@extends('admin.site')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Sản phẩm</h1>

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
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Kho</th>
                            <th>Chi tiết</th>
                            <th>Danh mục</th>
                            <th>Giới tính</th>
                            <th>Giảm giá</th>
                            <th>Ảnh</th>
                            <th colspan="2">Features</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{$item->product_id}}</td>
                            <td>{{$item->product_name}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->available}}</td>
                            <td>{{Str::limit($item->description, 10)}}</td>
                            <td>{{$item->category_id}}</td>
                            <td>{{$item->gender}}</td>
                            <td>{{$item->sale}}</td>
                            <td><img src="{{url('public/frontend/img/product')}}/{{$item->image}}" alt="" style="width: 50px; height: 50px;"></td>
                            <td><a class="btn btn-primary btn-sm text-white" href="{{route('editProduct', ['id' => $item->product_id])}}">Edit</a></td>
                            <td><a class="btn btn-danger btn-sm text-white" href="{{route('deleteProduct', ['id' => $item->product_id])}}" onClick="return confirm('Bạn xác nhận muốn xóa bản ghi ?')">Delete</a></td>
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