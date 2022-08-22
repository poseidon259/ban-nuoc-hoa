@extends('layouts.site')

@section('child-ui')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2 style="color: #000000;">Cửa hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="./" style="color: #000000;">Trang chủ</a>
                            <span style="color: #000000;">Cửa hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Danh mục nổi bật</h4>
                            <ul>
                                @foreach($data as $item)
                                <li><a href="#">{{$item->category_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>


                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Giảm giá</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach($productSale as $product)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{url('public/frontend')}}/img/product/{{$product->image}}">
                                            <div class="product__discount__percent">-{{$product->sale * 100}}%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="{{ route('product', ['id' => $product->product_id]) }}"><i class="fa fa-info" aria-hidden="true"></i></a></li>
                                                <li ><a href="{{ route('addProductToCart', ['id' => $product->product_id]) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Sale</span>
                                            <h5><a href="{{ route('product', ['id' => $product->product_id]) }}">{{$product->product_name}}</a></h5>
                                            <div class="product__item__price">${{$product->price - $product->price * $product->sale}} <span>${{$product->price}}</span></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{$amount}}</span> Sản phẩm</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $product)

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{url('public/frontend')}}/img/product/{{$product->image}}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="{{ route('product', ['id' => $product->product_id]) }}"><i class="fa fa-info" aria-hidden="true"></i></a></li>
                                        <li><a href="{{ route('addProductToCart', ['id' => $product->product_id]) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('product', ['id' => $product->product_id]) }}">{{$product->product_name}}</a></h6>
                                    <h5>${{$product->price}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="">
                        {{ $products->links() }}

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop()
