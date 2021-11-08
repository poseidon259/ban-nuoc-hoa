@extends('admin.site')
@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm phiếu nhập</h4>

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
                                        <label for="id">Mã phiếu nhập</label>
                                        <input type="text" id="id" class="form-control" name="id" readonly value="AUTO_INCREMENT">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Tên nhân viên</label>
                                        <input type="text" id="name" class="form-control" name="name" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address">Địa chỉ nơi nhập</label>
                                        <input type="text" id="address" class="form-control" name="address" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="date">Ngày nhập</label>
                                        <input type="date" id="date" class="form-control" name="date" >
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