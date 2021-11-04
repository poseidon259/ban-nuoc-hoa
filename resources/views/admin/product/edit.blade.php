@extends('admin.site')
@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Chỉnh sửa sản phẩm</h4>
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
                                        <input type="text" id="id" class="form-control" name="id" readonly value="{{$pEdit->product_id}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Tên sản phẩm</label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{$pEdit->product_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="price">Giá</label>
                                        <input type="text" id="price" class="form-control" name="price" value="{{$pEdit->price}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="available">Kho</label>
                                    <div class="form-group">
                                        <select class="form-control" id="available" name="available">
                                            <option value="0">Hết hàng</option>
                                            <option value="1">Còn hàng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="categoryP">Danh mục</label>
                                    <div class="form-group">
                                        <select class="form-control" id="categoryP" name="categoryP">
                                            @foreach($category as $item)
                                            <option value="{{$item->id  }}">{{$item->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="gender">Giới tính</label>
                                    <div class="form-group">
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="0">Nữ</option>
                                            <option value="1">Nam</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="sale">Giảm giá</label>
                                        <input type="text" id="sale" class="form-control" name="sale" value="{{$pEdit->sale}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="image">Ảnh</label>
                                    <div class="form-group">
                                        <input type="file" id="image" name="image"><br><br>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="description">Chi tiết sản phẩm</label>
                                        <textarea cols="5" rows="5" id="description" class="form-control" name="description"> {{$pEdit->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1" onClick="return confirm('Bạn xác nhận muốn sửa bản ghi ?')">Chỉnh sửa</button>
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