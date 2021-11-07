@extends('admin.site')
@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sửa tài khoản</h4>

                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="id">ID</label>
                                        <input type="text" id="id" class="form-control" name="id" readonly value="{{$user->id}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Tên tài khoản</label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" class="form-control" name="email" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" id="password" class="form-control" name="password" value="">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="date">Ngày tạo</label>
                                    <input type="date" id="date" class="form-control" name="date" value="{{$user->created_at}}">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="role">Quyền</label>
                                    <div class="form-group">
                                        <select class="form-control" id="role" name="role" >
                                            <option value="1">Admin</option>
                                            <option value="2">Employee</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1" onClick="return confirm('Bạn xác nhận muốn sửa bản ghi ?')">Xác nhận</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@stop