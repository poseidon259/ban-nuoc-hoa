@extends('layouts.site')
<!-- Hero Section End -->
@section('child-ui')


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thanh toán</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Trang chủ</a>
                        <span>Thanh toán</span>
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
        <div class="checkout__form">

            <h4>Hóa đơn</h4>
            <form action="{{route('processCheckout')}}" method="POST" class="handleCheckout">
                @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{Session::get('error')}}</strong>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="padding-left: 12px">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ<span>*</span></p>
                                    <input type="text" name="firstname">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Tên<span>*</span></p>
                                    <input type="text" name="lastname">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input type="text" name="address" class="checkout__input__add">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Điện thoại<span>*</span></p>
                                    <input type="text" name="phone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú</p>
                            <textarea cols="5" rows="5" class="form-control" name="note" id="note" placeholder="Ghi chú những yêu cầu đặc biệt."></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Sản phẩm của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Giá x Số lượng</span></div>
                            @php
                            $total=0;
                            @endphp
                            <ul>
                                @foreach ($cart as $key => $value)
                                @if(is_numeric($key))
                                <li>{{$value['product_name']}}<span>{{$value['price'] - $value['price'] * $value['sale']}} <i>x{{$value['quantity']}}</i></span> </li>
                                @php
                                $total += ($value['price'] - $value['price'] * $value['sale']) * $value['quantity'];
                                @endphp
                                @endif
                                @endforeach
                            </ul>

                            <div class="checkout__order__total">Tổng tiền <span>{{$total}}</span></div>
                            <button type="submit" class="site-btn">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
</body>

</html>

@endsection