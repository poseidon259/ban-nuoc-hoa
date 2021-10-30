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
                            <th>Ảnh</th>
                            <th>Chi tiết</th>
                            <th>Tag</th>
                            <th>Ngày tạo</th>
                            <th>Tác giả</th>
                            <th colspan="2">Features</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{$item->blog_id}}</td>
                            <td>{{$item->title}}</td>
                            <td><img src="{{url('public/frontend/img/blog')}}/{{$item->img}}" alt="" style="width: 50px; height: 50px;"></td>
                            <td>{{Str::limit($item->description, 10)}}</td>
                            <td>{{$item->tag}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->author}}</td>
                            <td><a class="btn btn-primary btn-sm text-white" href="{{route('editBlog', ['id' => $item->blog_id])}}">Edit</a></td>
                            <td><a class="btn btn-danger btn-sm text-white" href="{{route('deleteBlog', ['id' => $item->blog_id])}}" onClick="return confirm('Bạn xác nhận muốn xóa bản ghi ?')">Delete</a></td>
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