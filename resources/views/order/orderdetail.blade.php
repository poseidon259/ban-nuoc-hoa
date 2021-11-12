@extends('layouts.site')
<!-- Hero Section End -->
@section('child-ui')


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Theo dõi hóa đơn</h2>
                    <div class="breadcrumb__option">
                        <a href="">Trang chủ</a>
                        <span>Theo dõi hóa đơn</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
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
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                           <td>{{$order->id}}</td>
                           <td>{{$order->firstname}} {{$order->lastname}}</td>
                           <td>{{$order->email}}</td>
                           <td>{{$order->phone}}</td>
                           <td>{{$order->address}}</td>
                           <td>{{$order->note}}</td>
                           <td>{{$order->created_at}}</td>
                           @if($order->status == 0)
                           <td>Chưa xác nhận</td>
                           @else
                            <td>Đã xác nhận</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <h3>Sản phẩm</h3>
    <div class="card shadow mb-4 text-center">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Số lượng mua</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($order_detail as $item)
                        <tr>
                           <td>{{$item->order_id}}</td>
                           <td>{{$item->product_id}}</td>
                           <td>{{$item->product_name}}</td>
                           <td><img src="{{url('public/frontend/img/product')}}/{{$item->image}}" alt="" style="width: 50px; height: 50px;"></td>
                           <td>{{$item->quantity}}</td>
                           <td>{{$item->price}}</td>
                           @php
                            $total += $item->price * $item->quantity;
                            @endphp
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="6"> <b>Tổng tiền: {{$total}}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    </div>
</section>

</body>

</html>

@endsection