@extends('admin.site')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản trị</h1>

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
                            <th>Email</th>
                            <th>Mật khẩu</th>
                            <th>Ngày tạo</th>
                            <th>Quyền</th>
                            <th colspan="2">Features</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->password}}</td>
                            <td>{{date('Y-m-d', strtotime($item->created_at))}}</td>
                            @if($item->role == 0)
                            <td>God</td>
                            @elseif($item->role == 1)
                            <td>Admin</td>
                            @else
                            <td>User</td>
                            @endif
                            <td><a class="btn btn-primary btn-sm text-white" href="{{route('editUser', ['id' => $item->id])}}">Edit</a></td>
                            <td><a class="btn btn-danger btn-sm text-white" href="{{route('deleteUser', ['id' => $item->id])}}" onClick="return confirm('Bạn xác nhận muốn xóa bản ghi ?')">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<div class="">{{$user->links()}}</div>

@stop()