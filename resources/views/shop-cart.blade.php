@extends('layouts.site')
@section('child-ui')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @php
                                $total = 0;
                            @endphp
                            <tbody>
                                @foreach ($addedToCart as $id => $item)
                                @php
                                     $total += $item['price']*$item['quantity'];
                                @endphp
                                <tr>
                                    <td>{{$id}}</td>
                                    <td class="shoping__cart__item">
                                        <img style="width: 20%" src="{{url('public/frontend')}}/img/product/{{$item['image']}}" alt="">
                                        <h5>{{$item['name']}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{$item['price']}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{$item['quantity']}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        ${{$item['price']*$item['quantity']}}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="#" class="delete-cart" data-id="{{$id}}"  data-url="{{route('deleteCart', ['id'=>$id])}}"><span class="icon_close"></span></a>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span></span></li>
                            <li>Total: <span>{{$total}}</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
    <script src="{{url('public/frontend')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{url('public/frontend')}}/js/bootstrap.min.js"></script>
    <script src="{{url('public/frontend')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{url('public/frontend')}}/js/jquery-ui.min.js"></script>
    <script src="{{url('public/frontend')}}/js/jquery.slicknav.js"></script>
    <script src="{{url('public/frontend')}}/js/mixitup.min.js"></script>
    <script src="{{url('public/frontend')}}/js/owl.carousel.min.js"></script>
<script>
    function deleteCart(e) {
        e.preventDefault();
        alert('123')
        let urlCart = $(this).data('url');
        let id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: urlCart,
            data: {id: id},
            success: function(data) {
                // alert("Delete to cart")
            },
            error: function () {
                
            }
        })
    }
    $(function() {
        $('.delete-cart').on('click', deleteCart);
    })
</script>
@stop()