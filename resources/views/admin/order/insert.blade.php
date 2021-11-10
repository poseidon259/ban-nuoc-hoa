@extends('admin.site')
@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm đơn hàng</h4>

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
                        <form class="form" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="id">Mã đơn hàng</label>
                                        <input type="text" id="id" class="form-control" name="id" readonly value="AUTO_INCREMENT">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" class="form-control" name="email" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="firstname">Họ</label>
                                        <input type="text" id="firstname" class="form-control" name="firstname" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="lastname">Tên</label>
                                        <input type="text" id="lastname" class="form-control" name="lastname" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address">Địa chỉ người nhận</label>
                                        <input type="text" id="address" class="form-control" name="address" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="text" id="phone" class="form-control" name="phone" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="date">Ngày tạo</label>
                                        <input type="date" id="date" class="form-control" name="date" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="note">Ghi chú</label>
                                        <textarea cols="5" rows="5"class="form-control" name="note" id="note" placeholder="Ghi chú những yêu cầu đặc biệt."></textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1" onClick="return confirm('Bạn xác nhận muốn thêm mới bản ghi ?')">Thêm mới</button>
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