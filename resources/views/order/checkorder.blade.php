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
                        <a href="./index.html">Trang chủ</a>
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
        <div class="checkout__form">

            <h4>Thông tin hóa đơn</h4>
            <form action="" method="POST" class="handleCheckout">
                @if(Session::has('error'))
                <div class="alert alert-danger col-lg-4" style="margin: auto;" role="alert">
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
                    <div class="col-lg-8 col-md-6" style="margin: auto;">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="checkout__input">
                                    <p>Mã hóa đơn<span>*</span></p>
                                    <input type="text" name="id">
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="site-btn" style="margin-top: 2.8rem;">Xác nhận</button>
                            </div>
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