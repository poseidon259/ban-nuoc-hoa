<!-- Kế thừa Header and Footer -->
@extends('layouts.site')

@section('slider')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{url('public/frontend')}}/img/banner/banner-versace.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{url('public/frontend')}}/img/banner/banner-ck.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{url('public/frontend')}}/img/banner/banner-dior.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endsection
<!-- Main UI -->
@section('child-ui')

<!-- Categories Section Begin -->
<section class="categories" id="thuonghieu">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @for($i = 1; $i <= 12; $i++) <div class="col-md-4">
                    <div class="categories__item set-bg" data-setbg="{{url('public/frontend')}}/img/Categories/thuonghieu-{{$i}}.jpg">
                    </div>
            </div>
            @endfor
        </div>
    </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad" id="nuochoanam">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Nước Hoa Nam</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach($productForMan as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{url('public/frontend')}}/img/product/{{$product->image}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="{{ route('product', ['id' => $product->product_id]) }}"><i class="fa fa-info" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{ route('product', ['id' => $product->product_id]) }}">{{$product->product_name}}</a></h6>
                        <h5>${{$product->price}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    </div>
</section>
<!-- Featured Section End -->
<!-- Featured Section Begin -->
<section class="featured spad" id="nuochoanu">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Nước Hoa Nữ</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach($productForWoman as $product) 
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{url('public/frontend')}}/img/product/{{$product->image}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="{{ route('product', ['id' => $product->product_id]) }}"><i class="fa fa-info" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{ route('product', ['id' => $product->product_id]) }}">{{$product->product_name}}</a></h6>
                        <h5>${{$product->price}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{url('public/frontend')}}/img/banner/Banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{url('public/frontend')}}/img/banner/Banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Blog Section Begin -->
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @for($i = 1; $i < 4; $i++) <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{url('public/frontend')}}/img/Blog/blog{{ $i }}.jpg" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                        </ul>
                        <h5><a href="#">Cooking tips make cooking simple</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
        </div>
        @endfor
    </div>
    </div>
</section>
<!-- Blog Section End -->
@stop()