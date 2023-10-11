@extends('frontend.layout')
@section('content')
<main class="page-main bg-white mg-bot-60">
    <div class="grid wide page-express-checkout">
        <div class="page-title-wrapper">
            <h1 class="page-title">
                <span>Express Checkout</span>
            </h1>
        </div>
        <form class="row container" method="POST" action="">
            @csrf
            <div class="col l-8 m-12 c-12 checkout-wrapper">
                <div class="grid">
                    <div class="row">
                        <div class="col l-3 m-12 c-12 checkout-shipping-address-wrapper">
                        </div>
                        <div class="col l-9 m-12 c-12 checkout-methods-wrapper">
                            <div class="checkout-methods">
                                <div class="checkout-payment-method">
                                    <div class="checkout-title">
                                        <i class="far fa-credit-card"></i>
                                        <span>Payment Method</span>
                                        
                                        <div style="margin-top: 50px; font-size: 16px;">
                                            <div>Số thẻ: </div>
                                            <input type="text" style="width: 300px;margin-top: 15px" name="card-number">
                                            <div style="margin-top: 15px">CVV: </div>
                                            <input type="text" style="width: 300px;margin-top: 15px" name="cvv">
                                            <div style="margin-top: 15px">Hết hạn: </div>
                                            <input type="month" style="width: 300px;margin-top: 15px" name="exp">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l-4 m-12 c-12 checkout-sidebar-wrapper">
                <div class="checkout-sidebar">
                    <div class="block-summary">
                        <div class="checkout-title">
                            <span>Đơn hàng</span>
                        </div>
                        <div class="block items-in-cart">
                            <div class="title">
                                <span>{{ count(Session::get('carts')) }}</span>
                                <span>sản phẩm đang thanh toán</span>
                                <i class="ti-angle-up"></i>
                            </div>

                            <ul class="items-in-cart__list">
                                 @php
                                    $totalPirce = 0;
                                @endphp
                                @if (Session::has('carts'))
                                    @php
                                        $totalCart = Session::get('carts'); 
                                    @endphp
                                    @foreach ($totalCart as $carts)
                                        @php
                                            $totalPirce +=($carts['product']['price'] - ($carts['product']['price']*$carts['product']['discount'])/100)*$carts['quantity'];
                                        @endphp  
                                        <li class="items-in-cart__item">
                                            <div class="items-in-cart__img-wrapper">
                                                <div class="items-in-cart__img">
                                                    @php
                                                        $images = explode('|', $carts['product']['image']);
                                                    @endphp
                                                    <img src="{{ asset('uploads/'.$images[0]) }}">
                                                </div>
                                            </div>
                                            <div class="items-in-cart__detail">
                                                <div class="items-in-cart-name-block">
                                                    <a href="{{ route('productFrontend.index', [ $carts['product']['id'] ]) }}" class="product-name">
                                                        <span>{{ $carts['product']['name'] }}</span>
                                                    </a>
                                                </div>
                                                <div class="items-in-cart-subtotal">
                                                    <span class="price-excluding-tax">{{ number_format(ceil($carts['product']['price'] - ($carts['product']['price']*$carts['product']['discount'])/100)) }} VND</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>

                            <div class="cart-total">
                                <div class="cart-total-item">
                                    <div class="cart-total__title">
                                        <span>Tổng tiền</span>
                                    </div>
                                    <div class="cart-total__amount">
                                        <span>{{ number_format(ceil($totalPirce)); }} VND</span>
                                        <input type="hidden" name="totalMoney" value="{{ number_format(ceil($totalPirce)) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="block-comment">
                        <div class="field order-comment">
                            <label for="" class="label">
                                <span>Order comment</span>
                            </label>
                            <div class="option">
                                <textarea name="" id="" cols="3" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="place-order-btn ">
                        <button type="submit" class="btn-primary">
                            <span>Xác nhận thanh toán</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection