@extends('layouts.site')
@section('child-ui')

<!-- Breadcrumb Section Begin -->
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('home')}}">Home</a>
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
    <form class="form" method="post" action="{{route('checkout')}}">
        @csrf
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
                            <tbody>
                                @foreach($cart as $key => $value)
                                @if(is_numeric($key))
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{url('public/frontend')}}/img/product/{{$value['image']}}" style="width: 120px; height: 120px;" alt="">
                                        <h5>{{$value['product_name']}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{$value['price'] - $value['price'] * $value['sale']}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{$value['quantity']}}" name="{{$key}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        {{$value['price']}}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="{{ route('deleteCart', ['id' => $key]) }}"><span class="icon_close"></span></a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <div class="col-6 ">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span class="subtotal">-</span></li>
                            <li>Total <span class="total">-</span></li>
                        </ul>
                        <a href="{{route('checkout')}}"><button type="submit" class="primary-btn processTotal" style="margin-top: -2rem; cursor: pointer;"> PROCEED TO CHECKOUT</button></a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<!-- Shoping Cart Section End -->

<script>
    var amount = document.querySelectorAll('.shoping__cart__quantity input');
    var price = document.querySelectorAll('.shoping__cart__price');
    var elementTotal = document.querySelectorAll('.shoping__cart__total');
    var allElement = document.querySelectorAll('.shoping__cart__quantity .quantity');


    function total() {
        allElement.forEach((item, index) => {
            item.addEventListener('click', function() {
                elementTotal[index].innerHTML = Number(price[index].innerText) * Number(amount[index].value);

                var subtotal = 0;
                elementTotal.forEach(item => subtotal += Number(item.innerText));
                document.querySelector('.subtotal').innerHTML = subtotal;
                document.querySelector('.total').innerHTML = subtotal;
            });
        });
    }

    document.querySelector('.processTotal').addEventListener('click', function() {
        var total = 0;
        elementTotal.forEach(item => total += Number(item.innerText));
        document.querySelector('.subtotal').innerHTML = total;
        document.querySelector('.total').innerHTML = total;
    });
    total();
</script>
@stop()