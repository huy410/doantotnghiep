@extends('frontend.layout')
@section('content')
        <main class="page-main bg-white mg-bot-60" style="position: relative">
            <div class="grid wide page-cart-checkout">
                <div class="page-title-wrapper">
                    <h1 class="page-title">
                        <span>Giỏ hàng</span>
                    </h1>
                </div>
                <div class="row container">
                    <div class="col l-9 m-12 c-12 cart-main">
                        <form class="cart-main-wrapper" method="POST" action="{{ route('cart.update') }}">
                            @csrf
                            <div class="cart-main-title-wrapper">
                                <div class="cart-main-title">
                                    <div class="cart-main-title__item item">
                                        <span>Sản phẩm</span>
                                    </div>
                                    <div class="cart-main-title__item price">
                                        <span>Giá</span>
                                    </div>
                                    <div class="cart-main-title__item qty">
                                        <span>Số lượng</span>
                                    </div>
                                    <div class="cart-main-title__item subtotal">
                                        <span>Tổng tiền</span>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-main-product-list">
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
                                        <div class="cart-main-product-item">
                                        <div class="cart-main-product__info">
                                            <div class="cart-main-product__info-item">
                                                <div class="cart-main-product__img">
                                                    <a>
                                                        @php
                                                            $images = explode('|', $carts['product']['image']);
                                                        @endphp
                                                        <img src="{{ asset('uploads/'.$images[0]) }}">
                                                    </a>
                                                </div>
                                                <a href="{{ route('productFrontend.index', [ $carts['product']['id'] ]) }}" class="product-name">
                                                    <span>{{ $carts['product']['name'] }}</span>
                                                </a>
                                            </div>
                                            <div class="cart-main-product__info-detail-wrapper">
                                                <div class="cart-main-product__info-detail">
                                                    <div class="product-price">
                                                        <span class="price-final">{{ number_format(ceil($carts['product']['price'] - ($carts['product']['price']*$carts['product']['discount'])/100)) }} VND</span>
                                                    </div>
                                                    <div class="product-qty">
                                                        <div class="box-tocart__qty">
                                                            <a class="qty-down" onclick="subQuantity('#productQuantity{{ $carts['product']['name'] }}')">
                                                                <i class="fas fa-minus"></i>
                                                            </a>
                                                            
                                                            <input type="number" class="qty-control" id="productQuantity{{ $carts['product']['name'] }}" value="{{ $carts['quantity'] }}" name="{{ $carts['product']['id'] }}"> 

                                                            <a class="qty-up" onclick="upQuantity('#productQuantity{{ $carts['product']['name'] }}')">
                                                                <i class="fas fa-plus"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        function subQuantity(a) {
                                                            if( document.querySelector(a).value > 1 ) {
                                                                document.querySelector(a).value--;
                                                            }
                                                            
                                                        }
                                                        function upQuantity(a) {
                                                            document.querySelector(a).value++;
                                                        }
                                                    </script>

                                                    <div class="product-price-total-item">
                                                        <span>{{ number_format(ceil($carts['product']['price'] - ($carts['product']['price']*$carts['product']['discount'])/100)*$carts['quantity']) }} VND</span>
                                                    </div>
                                                </div>
                                                <div class="cart-main-product__action">
                                                    <a href="{{ route('cart.clearItem', [ $carts['product']['id'] ]) }}" class="action-remove" title="Remove item">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                
                            </div>
                            <div class="cart-main-action">
                                <div class="left">
                                    <a class="action-update btn-primary" href="{{ Session::has('taskUrl') ?  Session::get('taskUrl') : route('homeFrontend.index') }}">
                                        <i class="fas fa-sync-alt"></i>
                                        Tiếp tục mua sắm
                                    </a>
                                </div>
                                <div class="right">
                                    <a class="action-clear btn-primary" href="{{ route('cart.clearCart') }}">
                                        Làm trống giỏ hàng
                                    </a>
                                    <button type="submit" class="action-update btn-primary">
                                        <i class="fas fa-sync-alt"></i>
                                        Cập nhật giỏ hàng
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form action="{{ route('cart.checkout') }}" method="post" class="col l-3 m-12 c-12 cart-summary">
                        @csrf
                        <div class="cart-summary-title">
                            <span>Thanh toán</span>
                        </div>
                        <div class="block-shipping">
                            <div class="block-title">
                                <span>Địa điểm giao hàng</span>
                            </div>
                            
                            <div class="block-shipping-summary" style="margin-top: 20px">
                                <div class="field code">
                                    <div class="control">
                                        <input type="text" name="position" onkeyup="position123()" id="position1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cart-total">
                            <div class="cart-total-item">
                                <div class="cart-total__title">
                                    <span>Tổng tiền</span>
                                </div>
                                <div class="cart-total__amount">
                                    <span>{{ number_format(ceil($totalPirce)); }} VND</span>
                                </div>
                            </div>
                            <input type="hidden" name="price" value="{{ $totalPirce }}">
                        </div>

                        @if (Session::has('customer'))
                            <div class="cart-checkout" style="margin-top: 60px">
                                <div class="action">
                                    <button type="submit" class="btn-primary">Thanh toán trực tiếp</button>
                                </div>
                            </div>
                        
                        @else
                        <div class="cart-checkout" style="margin-top: 60px">
                            <div class="action">
                                <button type="submit" class="btn-primary">
                                    <a href="{{ route('frontend.login') }}" class="btn-primary">Đăng nhập tài khoản</a>
                                </button>
                            </div>
                        </div> 
                        @endif 

                        @if (Session::has('moneyError'))
                            <div style="color: red; font-size: 16px; margin-left: 30px; margin-bottom: 40px">
                                {{ Session::get('moneyError') }}
                            </div>       
                        @endif
                        @foreach ($errors->all() as $message)
                            <div style="color: red; font-size: 16px; margin-left: 30px; margin-bottom: 40px">
                                {{ $message }}
                            </div>           
                        @endforeach       
                    </form>
                    
                </div>
            </div>
        </main>
        
        <style>
            .popup_payment{
                background:rgba(0,0,0,.4);
                cursor:pointer;
                display:none;
                height:100%;
                width:100%;
                position:fixed;
                text-align:center;
                top:0;
                z-index:10000;
            }
            .stripe_text {
                margin-bottom: 20px;
            }
            .popup_payment h3 {
                float: left;
            }
            .popup_payment > div {
                background-color: #fff;
                box-shadow: 10px 10px 60px #555;
                display: inline-block;
                height: auto;
                max-width: 551px;
                border-radius: 8px;
                padding: 15px 5%;
                margin-top: 200px;       
                font-size: 11px                     
            }
            .popupCloseButton {
                background-color: #fff;
                border: 3px solid #999;
                border-radius: 50px;
                cursor: pointer;
                display: inline-block;
                font-family: arial;
                font-weight: bold;
                position: absolute;
                top: 198px;
                right: 563px;
                font-size: 25px;
                line-height: 30px;
                width: 30px;
                height: 30px;
                text-align: center;
            }
            .popupCloseButton:hover {
                background-color: #ccc;
            }
        </style>
        
        <script>
            document.querySelector(".stripe_btn").onclick = function() {
                document.querySelector(".popup_payment").style.display = 'block';
            }
            document.querySelector(".popupCloseButton").onclick = function() {
                document.querySelector(".popup_payment").style.display = 'none';
            }
            function position123() {
                document.querySelector("#position2").value =  document.querySelector("#position1").value;
            }
        </script>
@endsection