<!-- Kế thừa Header and Footer -->
@extends('layouts.site')

<!-- Main UI -->
@section('child-ui')
<!-- Hero Section Begin -->

<!-- Hero Section End -->



<!-- Categories Section Begin -->
<section class="categories" id="thuonghieu">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @for($i = 1; $i <= 12; $i++) 
                <div class="col-md-4">
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
            @for($i = 1; $i <= 8; $i++) 
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{url('public/frontend')}}/img/Featured/feature-{{$i}}.jpg">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-info" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            @endfor
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
            @for($i = 1; $i <= 8; $i++) 
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{url('public/frontend')}}/img/Featured/feature-{{$i}}.jpg">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-info" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            @endfor
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

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6" id="noibat">
                <div class="latest-product__text">
                    <h4>Nổi Bật</h4>
                    <div class="latest-product__slider owl-carousel">
                        @for($i = 1; $i < 3; $i++) 
                        <div class="latest-prdouct__slider__item">
                            @for($j = 1; $j < 4; $j++) 
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{url('public/frontend')}}/img/Latest-product/lp-{{$j}}.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            @endfor
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6" id="banchay">
                <div class="latest-product__text">
                    <h4>Bán Chạy</h4>
                    <div class="latest-product__slider owl-carousel">
                        @for($i = 1; $i < 3; $i++) 
                        <div class="latest-prdouct__slider__item">
                            @for($j = 1; $j < 4; $j++) 
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{url('public/frontend')}}/img/Latest-product/lp-{{$j}}.jpg" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            @endfor
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

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
            @for($i = 1; $i < 4; $i++) 
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{url('public/frontend')}}/img/Blog/blog-{{ $i }}.jpg" alt="">
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