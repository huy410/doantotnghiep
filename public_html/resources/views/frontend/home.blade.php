@extends('frontend.layout')
@section('content')
@if (Session::has('message'))
    <script>
        alert("{{ Session::get('message') }}")
    </script>
@endif
<main class="page-main">
    <div class="grid wide content-container ">
        <!-- Box on top -->
        <div class="row container content-box-on-top">
            <div class="col l-2 m-0 c-0"></div>
            <div class="col l-7 m-12 c-12 box-on-top__slider">
                <!-- Slider banner -->
                <div class="slider__banner">
                    <div class="slider__banner-wrapper">
                        <img class="slider__banner-img" src="{{ asset('assets/frontend/img/slider/armania_market1_03-1_slider.jpg') }}" alt="">
                        <div class="slider__banner-text">
                            <h3 class="slider__banner-text__title" style="color: white">New Generation<br>
                                Of Phone</h3>
                            <span class="slider__banner-text__msg">$200 Sale Off</span>
                            <div class="slider__banner-text__price">$299.9</div>
                            <button class="btn-primary slider__banner-text__buy-btn">SHOP NOW</button>
                        </div>
                    </div>
                </div>
                
                <div class="grid slider__product-tab">
                    <ul class="row slider__product-tab__list">
                        @forelse ($hotProducts as $hotProduct)
                            <li class="col l-3 m-6 c-12 slider__product-tab__item product-wrapper">
                                <div class="product-tab__info" style="width: 199px;">
                                    <div class="product-tab__info-img product-img">
                                        @php
                                            $imagesHotProucts = explode('|',$hotProduct->product->image)
                                        @endphp
                                        <img src="{{ asset('uploads/'.$imagesHotProucts[0]) }}" alt="">
                                    </div>
                                    <div class="product-tab__info-detail">
                                        <a href="{{ route('productFrontend.index', [$hotProduct->product->id]) }}"class="product-tab__info-detail__name product-name">{{ $hotProduct->product->name }}</a>
                                        <div class="product-tab__info-detail__price">
                                            <div class="price-final">
                                                <span>{{ number_format(ceil($hotProduct->product->price - ($hotProduct->product->price*$hotProduct->product->discount)/100)) }} VND</span>
                                            </div>
                                            <div class="price-old">
                                                <span>{{  number_format($hotProduct->product->price) }} VND</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
            @if (isset($bestSellProduct->product))
                <div class="col l-3 m-12 c-12 box-on-top__product-on-left">
                    <div class="product-on-left__wrapper">
                        <div class="product-on-left__bestseller">
                            Sản phẩm bán chạy nhất
                        </div>
                        <div class="row product-on-left__info-row product-wrapper">
                        
                            <div class="col l-12 m-4 c-6 product-on-left__info ">
                                <div class="product-on-left__info-img product-img">
                                    @php
                                        $imagesBestSellProducts = explode('|',$bestSellProduct->product->image)
                                    @endphp
                                    <img src="{{ asset('uploads/'.$imagesBestSellProducts[0]) }}" alt="">
                                </div>
                                <div class="product-on-left__info-detail product-name">
                                    <a href="{{ route('productFrontend.index', [$bestSellProduct->product->id]) }}" class="product-on-left__name product-name">
                                        <span>{{ $bestSellProduct->product->name }}</span>
                                    </a>
                                    <div class="product-on-left__price">
                                        <div class="price-final">
                                            <span>{{ number_format(ceil($bestSellProduct->product->price - ($bestSellProduct->product->price*$bestSellProduct->product->discount)/100)) }} VND</span>
                                        </div>
                                        <div class="price-old">
                                            <span>{{  number_format($bestSellProduct->product->price) }} VND</span>
                                        </div>
                                    </div>
                                </div>
                        
                            
                            </div>
    
                        </div>


                        <div class="product-on-left__images">
                            <div class="row product-on-left__images-row">
                                @for ($i = 0; $i < 3; $i++)
                                    <img src="{{ asset('uploads/'.$imagesBestSellProducts[$i]) }}" class="bestSellImg">
                                @endfor
                                <style>
                                    .bestSellImg{
                                        width: 116px;
                                        border-right: 1px solid grey;
                                    }
                                    .bestSellImg:last-child{
                                        border-right: none;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            @endif
        </div>

        <!-- Hot deal -->
        <div class="content-hot-deal container">
           

            <div class="row hot-deal__product">
                @forelse ($mostDiscountProducts as $mostDiscountProduct)
                    <div class="col l-4 m-6 c-12 hot-deal__product-wrapper">
                        <div class="hot-deal__product-img">
                            @php
                                $imagesmostDiscountProducts = explode('|',$mostDiscountProduct->image)
                            @endphp
                            <img src="{{ asset('uploads/'.$imagesmostDiscountProducts[0]) }}" alt="">
                        </div>
                        <div class="hot-deal__product-detail">
                            <a href="{{ route('productFrontend.index', [$mostDiscountProduct->id]) }}" class="hot-deal__product-detail__name product-name">{{ $mostDiscountProduct->name }}</a>
                            <div class="hot-deal__product-detail__price">
                                <div class="price-final">{{ number_format(ceil($mostDiscountProduct->price - ($mostDiscountProduct->price*$mostDiscountProduct->discount)/100)) }} VND</div>
                                <div class="price-old">{{ number_format($mostDiscountProduct->price) }} VND</div>
                            </div>
                            <div class="hot-deal__product-detail__des">
                                <ul>
                                    <li>Small screen 7.9" Retina</li>
                                    <li>Compatible with Apple Pencil</li>
                                </ul>
                            </div>
                            <span class="hot-deal__product-detail__sale">
                                <span class="hot-deal__sale-title">SALES</span>
                                <span class="hot-deal__sale-title-text">{{ $mostDiscountProduct->discount }}% OFF</span>
                            </span>
                            <div class="hot-deal__product-detail__action">
                                <a href="{{ route('cart.quickAddToCart', ['id'=> $mostDiscountProduct->id] ) }}" class="hot-deal__product-detail__btn btn">Thêm giỏ hàng</a>
                                <div class="hot-deal__product-detail__link product-action">
                                    <a class="add-to-wish-list">
                                        <a href="{{ addToWishList( $mostDiscountProduct->id) }}"><i class="add-to-cart far fa-heart"></i></a>
                                        </a>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
               
            </div>
        </div>

        <!-- Hot categories -->
        <div class="content-hot-categories container">
            <div class="hot-categories__heading">
                <div class="hot-categories__heading-wrapper">
                    <ul class="hot-categories__list">
                        <li class="hot-categories__titile tag-title" style="padding: 15px 30px">
                            <h3>Các sản phẩm hot</h3>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="grid wide hot-categories__product">
                <div class="hot-categories__product-wrapper">
                    <ul class="row hot-categories__product-list">
                        @forelse ($showHotProducts as $showHotProduct)
                            <li class="col l-1-7 m-3 c-6 hot-categories__product-item product-wrapper">
                                <div class="hot-categories__product-img product-img">
                                    @php
                                        $imgshowHotProduct = explode('|', $showHotProduct->image);
                                    @endphp
                                    <img src="{{ asset('uploads/'.$imgshowHotProduct[0]) }}" alt="">
                                </div>
                                <span class="hot-categories__product-sale onsale">
                                    <span>{{ $showHotProduct->discount }}%</span>
                                </span>
                                <div class="hot-categories__product-action product-action">
                                    <a href="{{ route('cart.quickAddToCart', ['id'=> $showHotProduct->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                    <a href="{{  addToWishList( $showHotProduct->id) }}"><i class="add-to-cart far fa-heart"></i></a>
                                </div>
                                <div class="hot-categories__product-detail">
                                    <a href="{{ route('productFrontend.index', [$showHotProduct->id]) }}" class="hot-categories__product__name product-name">{{ $showHotProduct->name }}</a>
                                </div>
                                <div class="product-review-summary">
                                    <div class="rating-result">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if(isset($showHotProduct->review_avg_total_star))
                                                @if ($i < $showHotProduct->review_avg_total_star )
                                                    <i class="rating-icon rating-icon--active far fa-star"></i>
                                                @else
                                                    <i class="rating-icon far fa-star"></i>
                                                @endif
                                            @else
                                                <i class="rating-icon far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="rating-action">
                                        <a class="action-view">
                                            {{ $showHotProduct->review_count }}
                                        </a>
                                    </div>
                                </div>
                                <div class="hot-categories__product__price">
                                    <div class="price-final">{{ number_format(ceil($showHotProduct->price - ($showHotProduct->price*$showHotProduct->discount)/100)) }} VND</div>
                                    <div class="price-old">{{ number_format($showHotProduct->price) }} VND</div>
                                </div>
                            </li>
                        @empty
                        @endforelse
                        
                    </ul>
                </div>
            </div>
        </div>

        <!-- Catagories tabs full screen-->
        <div class="content-product-category container mg-bot-60">
            <div class="product-category__wrapper wrapper">
                <ul class="content-product-category__heading tabs-nav tag-title__wrapper">
                    <li class="tag-title ">
                        <h2>{{ $listHotCategory[0]->name }}</h2>
                    </li>
                </ul>

                <div class="grid wide">
                    <div class="row">
                        <div class="col l-2 m-3 c-0 product-category__banner tab-banner">
                            <img src="{{ asset('assets/frontend/img/banners/2-banner-market_m-01.jpg') }}" alt="">
                        </div>

                        <div class="col l-10 m-9 c-12 product-category__content">
                            <div class="grid wide product-category__content-wrapper">
                                <ul class="row product-category__row overflow-x-auto">
                                    @for ($i = 0; $i < 5; $i++)
                                        <li class="col l-2-4 m-4 c-6 product-wrapper product-wrapper--medium">
                                            <div class="product-img">
                                                @php
                                                    $imgProductListHotCategory = explode('|', $listHotCategory[0]->product[$i]->image);
                                                @endphp
                                                <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                            </div>
                                            <div class="product-action">
                                                <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[0]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                                <a href="{{ addToWishList($listHotCategory[0]->product[$i]) }}"><i class="add-to-cart add-to-cart far fa-heart"></i></a>
                                            </div>
                                            <div class="product__detail">
                                                <a href="{{ route('productFrontend.index', [$listHotCategory[0]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[0]->product[$i]->name }}</a>
                                                <div class="product-price group-product__price">
                                                    <div class="price-final">{{ number_format(ceil($listHotCategory[0]->product[$i]->price - ($listHotCategory[0]->product[$i]->price*$listHotCategory[0]->product[$i]->discount)/100)) }} VND</div>
                                                    <div class="price-old">{{ number_format($listHotCategory[0]->product[$i]->price) }} VND</div>
                                                </div>
                                            </div>
                                            <span class="onsale onsale--right">
                                                <span>{{ $listHotCategory[0]->product[$i]->discount }} %</span>
                                            </span>
                                        </li>
                                    @endfor
                                </ul>
                                <ul class="row product-category__row overflow-x-auto">
                                    @for ($i = 0; $i < 5; $i++)
                                        <li class="col l-2-4 m-4 c-6 product-wrapper product-wrapper--medium">
                                            <div class="product-img">
                                                @php
                                                    $imgProductListHotCategory = explode('|', $listHotCategory[0]->product[$i]->image);
                                                @endphp
                                                <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                            </div>
                                            <div class="product-action">
                                                <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[0]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                                <a href="{{ addToWishList($listHotCategory[0]->product[$i]) }}"><i class="add-to-cart far fa-heart"></i></a>
                                            </div>
                                            <div class="product__detail">
                                                <a href="{{ route('productFrontend.index', [$listHotCategory[0]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[0]->product[$i]->name }}</a>
                                                <div class="product-price group-product__price">
                                                    <div class="price-final">{{ number_format(ceil($listHotCategory[0]->product[$i]->price - ($listHotCategory[0]->product[$i]->price*$listHotCategory[0]->product[$i]->discount)/100)) }} VND</div>
                                                    <div class="price-old">{{ number_format($listHotCategory[0]->product[$i]->price) }} VND</div>
                                                </div>
                                            </div>
                                            <span class="onsale onsale--right">
                                                <span>{{ $listHotCategory[0]->product[$i]->discount }} %</span>
                                            </span>
                                        </li>
                                    @endfor
                                </ul>

                            </div>
                        </div>
                    </div>
                </div> 
                <div class="grid wide">
                    <div class="row content-product-category__brand brand-list">
                    <div  class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                        <img src="{{ asset('assets/frontend/img/brands/brand-01.png') }}" alt="">
                    </div>
                    <div  class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                        <img src="{{ asset('assets/frontend/img/brands/brand-02.png') }}" alt="">
                    </div>
                    <div  class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                        <img src="{{ asset('assets/frontend/img/brands/brand-03.png') }}" alt="">
                    </div>
                    <div  class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                        <img src="{{ asset('assets/frontend/img/brands/brand-04.png') }}" alt="">
                    </div>
                    <div  class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                        <img src="{{ asset('assets/frontend/img/brands/brand-05.png') }}" alt="">
                    </div>
                    <div  class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                        <img src="{{ asset('assets/frontend/img/brands/brand-06.png') }}" alt="">
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banners images -->
        <div class="grid wide content-banner-images container mg-bot-60 ">
            <div class="row">
                <div class="col l-4 m-4 c-12 banner-wrapper">
                    <div class="banner-img img-hover-light-effect">
                        <div>
                            <img src="{{ asset('assets/frontend/img/banners/3-banner-market_hor-m-01.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col l-4 m-4 c-12 banner-wrapper">
                    <div class="banner-img img-hover-light-effect">
                        <div>
                            <img src="{{ asset('assets/frontend/img/banners/3-banner-market_hor-m-02.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col l-4 m-4 c-12 banner-wrapper">
                    <div class="banner-img img-hover-light-effect">
                        <div>
                            <img src="{{ asset('assets/frontend/img/banners/3-banner-market_hor-m-03.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories tabs double -->
        <div class="grid wide content-product-category ">
            <div class="row product-category__wrapper wrapper">
                <div class="col l-6 m-12 c-12 category-tab-container container mg-bot-60">
                    <ul class="content-product-category__heading tabs-nav tag-title__wrapper">
                        <li class="tag-title ">
                            <h2>{{ $listHotCategory[1]->name }}</h2>
                        </li>
                    </ul>
                    <div class="grid wide">
                        <div class="row">
                            <div class="col l-4 m-3 c-0 product-category__banner tab-banner banner-wrapper">
                                <div class="banner-img img-hover-light-effect">
                                    <img src="{{ asset('assets/frontend/img/banners/3-banner-market_m-01.jpg') }}" alt="">
                                </div>
                            </div>

                            <div class="col l-8 m-9 c-12 product-category__content">
                                <div class="grid wide product-category__content-wrapper">
                                    <ul class="row product-category__row overflow-x-auto">
                                        @for ($i = 0; $i < 2; $i++)
                                            <li class="col l-6 m-4 c-6 product-wrapper product-wrapper--medium">
                                                @php
                                                    $imgProductListHotCategory = explode('|', $listHotCategory[1]->product[$i]->image);
                                                @endphp
                                                <div class="product-img">
                                                    <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                                </div>
                                                <div class="product-action">
                                                    <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[1]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                                    <a href="{{ addToWishList($listHotCategory[1]->product[$i]) }}"><i class="add-to-cart far fa-heart"></i></a>
                                                </div>
                                                <div class="product__detail">
                                                    <a href="{{ route('productFrontend.index', [$listHotCategory[1]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[1]->product[$i]->name }}</a>
                                                    <div class="product-price group-product__price">
                                                        <div class="price-final">{{ number_format(ceil($listHotCategory[1]->product[$i]->price - ($listHotCategory[1]->product[$i]->price*$listHotCategory[1]->product[$i]->dicount)/100 )) }} VND</div>
                                                        <div class="price-old">{{ number_format($listHotCategory[1]->product[$i]->price) }} VND</div>
                                                    </div>
                                                </div>
                                                <span class="onsale onsale--right">
                                                    <span>{{ $listHotCategory[1]->product[$i]->discount }}%</span>
                                                </span>
                                            </li>
                                        @endfor
                                    </ul>
                                    <ul class="row product-category__row overflow-x-auto">
                                        @for ($i = 2; $i < 4; $i++)
                                            <li class="col l-6 m-4 c-6 product-wrapper product-wrapper--medium">
                                                @php
                                                    $imgProductListHotCategory = explode('|', $listHotCategory[1]->product[$i]->image);
                                                @endphp
                                                <div class="product-img">
                                                    <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                                </div>
                                                <div class="product-action">
                                                    <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[1]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                                    <a href="{{ addToWishList($listHotCategory[1]->product[$i]) }}"><i class="add-to-cart far fa-heart"></i></a>
                                                </div>
                                                <div class="product__detail">
                                                    <a href="{{ route('productFrontend.index', [$listHotCategory[1]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[1]->product[$i]->name }}</a>
                                                    <div class="product-price group-product__price">
                                                        <div class="price-final">{{ number_format(ceil($listHotCategory[1]->product[$i]->price - ($listHotCategory[1]->product[$i]->price*$listHotCategory[1]->product[$i]->dicount)/100 )) }} VND</div>
                                                        <div class="price-old">{{ number_format($listHotCategory[1]->product[$i]->price) }} VND</div>
                                                    </div>
                                                </div>
                                                <span class="onsale onsale--right">
                                                    <span>{{ $listHotCategory[1]->product[$i]->discount }}%</span>
                                                </span>
                                            </li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid wide">
                        <div class="row content-product-category__brand brand-list-haft brand-list">
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-01.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-02.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-03.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-04.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l-6 m-12 c-12 category-tab-container container mg-bot-60">
                    <ul class="content-product-category__heading tabs-nav tag-title__wrapper">
                        <li class="tag-title ">
                            <h2>{{ $listHotCategory[2]->name }}</h2>
                        </li>
                    </ul>
                    <div class="grid wide">
                        <div class="row">
                            <div class="col l-4 m-3 c-0 product-category__banner tab-banner banner-wrapper">
                                <div class="banner-img img-hover-light-effect">
                                    <img src="{{ asset('assets/frontend/img/banners/3-banner-market_m-02.jpg') }}" alt="">
                                </div>
                            </div>

                            <div class="col l-8 m-9 c-12 product-category__content">
                                <div class="grid wide product-category__content-wrapper">
                                    <ul class="row product-category__row overflow-x-auto">
                                        @for ($i = 0; $i < 2; $i++)
                                            <li class="col l-6 m-4 c-6 product-wrapper product-wrapper--medium">
                                                <div class="product-img">
                                                    @php
                                                        $imgProductListHotCategory = explode('|', $listHotCategory[2]->product[$i]->image);
                                                    @endphp
                                                    <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                                </div>
                                                <div class="product-action">
                                                    <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[2]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                                    <a href="{{ addToWishList($listHotCategory[2]->product[$i]) }}"><i class="add-to-cart far fa-heart"></i></a>
                                                </div>
                                                <div class="product__detail">
                                                    <a href="{{ route('productFrontend.index', [$listHotCategory[2]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[2]->product[$i]->name }}</a>
                                                    <div class="product-price group-product__price">
                                                        <div class="price-final">{{ number_format(ceil($listHotCategory[2]->product[$i]->price - ($listHotCategory[2]->product[$i]->price*$listHotCategory[2]->product[$i]->dicount)/100 )) }} VND</div>
                                                        <div class="price-old">{{ number_format($listHotCategory[2]->product[$i]->price) }} VND</div>
                                                    </div>
                                                </div>
                                                <span class="onsale onsale--right">
                                                    <span>{{ $listHotCategory[2]->product[$i]->discount }}%</span>
                                                </span>
                                            </li>
                                        @endfor
                                    </ul>
                                    <ul class="row product-category__row overflow-x-auto">
                                        @for ($i = 2; $i < 4; $i++)
                                            <li class="col l-6 m-4 c-6 product-wrapper product-wrapper--medium">
                                                <div class="product-img">
                                                    @php
                                                        $imgProductListHotCategory = explode('|', $listHotCategory[2]->product[$i]->image);
                                                    @endphp
                                                    <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                                </div>
                                                <div class="product-action">
                                                    <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[2]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                                    <a href="{{ addToWishList($listHotCategory[2]->product[$i]) }}"><i class="add-to-cart far fa-heart"></i></a>
                                                </div>
                                                <div class="product__detail">
                                                    <a href="{{ route('productFrontend.index', [$listHotCategory[2]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[2]->product[$i]->name }}</a>
                                                    <div class="product-price group-product__price">
                                                        <div class="price-final">{{ number_format(ceil($listHotCategory[2]->product[$i]->price - ($listHotCategory[2]->product[$i]->price*$listHotCategory[2]->product[$i]->dicount)/100 )) }} VND</div>
                                                        <div class="price-old">{{ number_format($listHotCategory[2]->product[$i]->price) }} VND</div>
                                                    </div>
                                                </div>
                                                <span class="onsale onsale--right">
                                                    <span>{{ $listHotCategory[2]->product[$i]->discount }}%</span>
                                                </span>
                                            </li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid wide">
                        <div class="row content-product-category__brand brand-list-haft brand-list">
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-01.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-02.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-03.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-04.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Categories tabs double -->
        <div class="grid wide content-product-category">
            <div class="row product-category__wrapper wrapper">
                <div class="col l-6 m-12 c-12 category-tab-container container mg-bot-60">
                    <ul class="content-product-category__heading tabs-nav tag-title__wrapper">
                        <li class="tag-title ">
                            <h2>{{ $listHotCategory[3]->name }}</h2>
                        </li>
                    </ul>
                    <div class="grid wide">
                        <div class="row">
                            <div class="col l-4 m-3 c-0 product-category__banner tab-banner banner-wrapper">
                                <div class="banner-img img-hover-light-effect">
                                    <img src="{{ asset('assets/frontend/img/banners/4-banner-market_m-01.jpg') }}" alt="">
                                </div>
                            </div>

                            <div class="col l-8 m-9 c-12 product-category__content">
                                <div class="grid wide product-category__content-wrapper">
                                    <ul class="row product-category__row overflow-x-auto">
                                        @for ($i = 0; $i < 2; $i++)
                                            <li class="col l-6 m-4 c-6 product-wrapper product-wrapper--medium">
                                                <div class="product-img">
                                                    @php
                                                        $imgProductListHotCategory = explode('|', $listHotCategory[3]->product[$i]->image);
                                                    @endphp
                                                    <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                                </div>
                                                <div class="product-action">
                                                    <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[3]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                                    <a href="{{ addToWishList($listHotCategory[3]->product[$i]) }}"><i class="add-to-cart far fa-heart"></i></a>
                                                </div>
                                                <div class="product__detail">
                                                    <a href="{{ route('productFrontend.index', [$listHotCategory[3]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[3]->product[$i]->name }}</a>
                                                    <div class="product-price group-product__price">
                                                        <div class="price-final">{{ number_format(ceil($listHotCategory[3]->product[$i]->price - ($listHotCategory[3]->product[$i]->price*$listHotCategory[3]->product[$i]->dicount)/100 )) }} VND</div>
                                                        <div class="price-old">{{  number_format($listHotCategory[3]->product[$i]->price) }} VND</div>
                                                    </div>
                                                </div>
                                                <span class="onsale onsale--right">
                                                    <span>{{ $listHotCategory[3]->product[$i]->discount }}%</span>
                                                </span>
                                            </li>
                                        @endfor
                                    </ul>
                                    <ul class="row product-category__row overflow-x-auto">
                                        @for ($i = 2; $i < 4; $i++)
                                            <li class="col l-6 m-4 c-6 product-wrapper product-wrapper--medium">
                                                <div class="product-img">
                                                    @php
                                                        $imgProductListHotCategory = explode('|', $listHotCategory[3]->product[$i]->image);
                                                    @endphp
                                                    <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                                </div>
                                                <div class="product-action">
                                                    <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[3]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                                    <a href="{{ addToWishList($listHotCategory[3]->product[$i]) }}"><i class="add-to-cart far fa-heart"></i></a>
                                                </div>
                                                <div class="product__detail">
                                                    <a href="{{ route('productFrontend.index', [$listHotCategory[3]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[3]->product[$i]->name }}</a>
                                                    <div class="product-price group-product__price">
                                                        <div class="price-final">{{ number_format(ceil($listHotCategory[3]->product[$i]->price - ($listHotCategory[3]->product[$i]->price*$listHotCategory[3]->product[$i]->dicount)/100 )) }} VND</div>
                                                        <div class="price-old">{{  number_format($listHotCategory[3]->product[$i]->price) }} VND</div>
                                                    </div>
                                                </div>
                                                <span class="onsale onsale--right">
                                                    <span>{{ $listHotCategory[3]->product[$i]->discount }}%</span>
                                                </span>
                                            </li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid wide">
                        <div class="row content-product-category__brand brand-list-haft brand-list">
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-01.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-02.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-03.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-04.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col l-6 m-12 c-12 category-tab-container container mg-bot-60">
                    <ul class="content-product-category__heading tabs-nav tag-title__wrapper">
                        <li class="tag-title ">
                            <h2>{{ $listHotCategory[4]->name }}</h2>
                        </li>
                    </ul>
                    <div class="grid wide">
                        <div class="row">
                            <div class="col l-4 m-3 c-0 product-category__banner tab-banner banner-wrapper">
                                <div class="banner-img img-hover-light-effect">
                                    <img src="{{ asset('assets/frontend/img/banners/4-banner-market_m-02.jpg') }}" alt="">
                                </div>
                            </div>

                            <div class="col l-8 m-9 c-12 product-category__content">
                                <div class="grid wide product-category__content-wrapper">
                                    <ul class="row product-category__row overflow-x-auto">
                                        @for ($i = 0; $i < 2; $i++)
                                            <li class="col l-6 m-4 c-6 product-wrapper product-wrapper--medium">
                                                <div class="product-img">
                                                    @php
                                                        $imgProductListHotCategory = explode('|', $listHotCategory[4]->product[$i]->image);
                                                    @endphp
                                                    <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                                </div>
                                                <div class="product-action">
                                                    <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[4]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                                    <a href="{{ addToWishList($listHotCategory[4]->product[$i]) }}"><i class="add-to-cart far fa-heart"></i></a>
                                                </div>
                                                <div class="product__detail">
                                                    <a href="{{ route('productFrontend.index', [$listHotCategory[4]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[4]->product[$i]->name }}</a>
                                                    <div class="product-price group-product__price">
                                                        <div class="price-final">{{ number_format(ceil($listHotCategory[4]->product[$i]->price - ($listHotCategory[4]->product[$i]->price*$listHotCategory[4]->product[$i]->dicount)/100 )) }} VND</div>
                                                        <div class="price-old">{{ number_format($listHotCategory[4]->product[$i]->price) }} VND</div>
                                                    </div>
                                                </div>
                                                <span class="onsale onsale--right">
                                                    <span>{{ $listHotCategory[4]->product[$i]->discount }}%</span>
                                                </span>
                                            </li>
                                        @endfor
                                    </ul>
                                    <ul class="row product-category__row overflow-x-auto">
                                        @for ($i = 2; $i < 4; $i++)
                                            <li class="col l-6 m-4 c-6 product-wrapper product-wrapper--medium">
                                                <div class="product-img">
                                                    @php
                                                        $imgProductListHotCategory = explode('|', $listHotCategory[4]->product[$i]->image);
                                                    @endphp
                                                    <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                                </div>
                                                <div class="product-action">
                                                    <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[4]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                                    <a href="{{ addToWishList($listHotCategory[4]->product[$i]) }}"><i class="add-to-cart far fa-heart"></i></a>
                                                </div>
                                                <div class="product__detail">
                                                    <a href="{{ route('productFrontend.index', [$listHotCategory[4]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[4]->product[$i]->name }}</a>
                                                    <div class="product-price group-product__price">
                                                        <div class="price-final">{{ number_format(ceil($listHotCategory[4]->product[$i]->price - ($listHotCategory[4]->product[$i]->price*$listHotCategory[4]->product[$i]->dicount)/100 )) }} VND</div>
                                                        <div class="price-old">{{ number_format($listHotCategory[4]->product[$i]->price) }} VND</div>
                                                    </div>
                                                </div>
                                                <span class="onsale onsale--right">
                                                    <span>{{ $listHotCategory[4]->product[$i]->discount }}%</span>
                                                </span>
                                            </li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid wide">
                        <div class="row content-product-category__brand brand-list-haft brand-list">
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-01.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-02.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-03.png') }}" alt="">
                            </div>
                            <div class="col l-2 m-3 c-4 product-category__brand-link brand-img">
                                <img src="{{ asset('assets/frontend/img/brands/brand-04.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Group product -->
        <div class="content-group-product">
            <div class="row ">
                <div class="col l-6 m-12 c-12 container mg-bot-60">
                    <div class="group-product-container ">
                        <div class="group-product__heading tag-title__wrapper">
                            <div class="tag-title">
                                <h2>{{  $listHotCategory[5]->name }}</h2>
                            </div>
                        </div>
                        <div class="grid wide">
                            <ul class="row group-product__list overflow-x-auto">
                                @for ($i = 0; $i < 3; $i++)
                                    <li class="col l-4 m-3 c-6 product-wrapper">
                                        <div class="product-img">
                                            @php
                                                $imgProductListHotCategory = explode('|', $listHotCategory[5]->product[$i]->image);
                                            @endphp
                                            <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                        </div>
                                        <div class="product-action">
                                            <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[5]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                            <a href="{{ addToWishList($listHotCategory[5]->product[$i]) }}"><i class="add-to-cart far fa-heart"></i></a>
                                        </div>
                                        <a href="{{ route('productFrontend.index', [$listHotCategory[5]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[5]->product[$i]->name }}</a>
                                        <div class="product-price">
                                            <div class="price-final">{{ number_format(ceil($listHotCategory[5]->product[$i]->price - ($listHotCategory[5]->product[$i]->price*$listHotCategory[5]->product[$i]->diccount)/100)) }} VND</div>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                            <ul class="row group-product__list overflow-x-auto">
                                @for ($i = 0; $i < 3; $i++)
                                    <li class="col l-4 m-3 c-6 product-wrapper">
                                        <div class="product-img">
                                            @php
                                                $imgProductListHotCategory = explode('|', $listHotCategory[5]->product[$i]->image);
                                            @endphp
                                            <img src="{{ asset('uploads/'.$imgProductListHotCategory[0]) }}" alt="">
                                        </div>
                                        <div class="product-action">
                                            <a href="{{ route('cart.quickAddToCart', ['id'=> $listHotCategory[5]->product[$i]->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                            <a href="{{ addToWishList($listHotCategory[5]->product[$i]) }}"><i class="add-to-cart far fa-heart"></i></a>
                                        </div>
                                        <a href="{{ route('productFrontend.index', [$listHotCategory[5]->product[$i]->id]) }}" class="product-name">{{ $listHotCategory[5]->product[$i]->name }}</a>
                                        <div class="product-price">
                                            <div class="price-final">{{ number_format(ceil($listHotCategory[5]->product[$i]->price - ($listHotCategory[5]->product[$i]->price*$listHotCategory[5]->product[$i]->diccount)/100)) }} VND</div>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col l-6 m-12 c-12">
                    <div class="grid wide group-product-container">
                        <div class="row">
                            <div class="col l-6 container mg-bot-60">
                                <div class="group-product__heading tag-title__wrapper">
                                    <div class="tag-title">
                                        <h2>Sản phẩm hot của tuần</h2>
                                    </div>
                                </div>
                                <div class="grid wide">
                                    @forelse ($bestWeekProduct as $hotProduct)
                                        <ul class="row group-product__list overflow-x-auto">
                                            <li class="col l-12 m-6 c-12 product-wrapper no-border group-product__item">
                                                <div class="item-horizontal">
                                                    <div class="product-img">
                                                        @php
                                                            $imagesHotProucts = explode('|',$hotProduct->product->image)
                                                        @endphp
                                                        <img src="{{ asset('uploads/'.$imagesHotProucts[0]) }}" alt="">
                                                    </div>
                                                    <div class="group-product__detail product-info">
                                                        <a href="{{ route('productFrontend.index', [$bestSellProduct->product->id]) }}" class="product-name">{{  $bestSellProduct->product->name }}</a>
                                                        <div class="product-price group-product__price">
                                                            <div class="price-final">
                                                                {{ number_format(ceil($bestSellProduct->product->price - ($bestSellProduct->product->price*$bestSellProduct->product->discount)/100)) }} VND
                                                            </div>
                                                            <div class="price-old">
                                                                {{  number_format($bestSellProduct->product->price) }} VND
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="group-product__sale onsale">
                                                        <span>{{  number_format($bestSellProduct->product->discount) }}%</span>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            
                            <div class="col l-6 container mg-bot-60">
                                <div class="group-product__heading tag-title__wrapper">
                                    <div class="tag-title">
                                        <h2>Top sản phẩm hot của ngày</h2>
                                    </div>
                                </div>

                                <div class="grid wide">
                                    @forelse  ($bestDayProduct as $hotProduct)
                                        <ul class="row group-product__list overflow-x-auto">
                                            <li class="col l-12 m-6 c-12 product-wrapper no-border group-product__item">
                                                <div class="item-horizontal">
                                                    <div class="product-img">
                                                        @php
                                                            $imagesHotProucts = explode('|',$hotProduct->product->image)
                                                        @endphp
                                                        <img src="{{ asset('uploads/'.$imagesHotProucts[0]) }}" alt="">
                                                    </div>
                                                    <div class="group-product__detail product-info">
                                                        <a href="{{ route('productFrontend.index', [$bestSellProduct->product->id]) }}" class="product-name">{{  $bestSellProduct->product->name }}</a>
                                                        <div class="product-price group-product__price">
                                                            <div class="price-final">
                                                                {{ number_format(ceil($bestSellProduct->product->price - ($bestSellProduct->product->price*$bestSellProduct->product->discount)/100)) }} VND
                                                            </div>
                                                            <div class="price-old">
                                                                {{  number_format($bestSellProduct->product->price) }} VND
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="group-product__sale onsale">
                                                        <span>{{  number_format($bestSellProduct->product->discount) }}%</span>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Banners images -->
        <div class="grid wide content-banner-images container mg-bot-60 ">
            <div class="row">
                <div class="col l-4 m-4 c-12 banner-wrapper">
                    <div class="banner-img ">
                        <div>
                            <img src="{{ asset('assets/frontend/img/banners/5-banner-market_s-01.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col l-4 m-4 c-12 banner-wrapper">
                    <div class="banner-img ">
                        <div>
                            <img src="{{ asset('assets/frontend/img/banners/5-banner-market_s-02.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col l-4 m-4 c-12 banner-wrapper">
                    <div class="banner-img ">
                        <div>
                            <img src="{{ asset('assets/frontend/img/banners/5-banner-market_s-03.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- News letter -->
    <div class="content-newsletter">
        <div class="container">
            <div class="newsletter__title">
                <h3>Join Our Newsletter Now</h3>
            </div>
            <div class="newsletter__content">
                <form action="" class="news-letter__subcribe">
                    <div class="newsletter__field">
                        <div class="newsletter__control">
                            <div class="newsletter__input">
                                <input type="email" placeholder="Enter your email">
                            </div>
                            <div class="newsletter__action">
                                <button type="submit">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <p class="newsletter__des">
                Will be used in accordance with our 
                <a>Privacy Policy</a>
            </p>
        </div>
    </div>
    
    <!-- Shipping support -->
    <div class="content-shipping-support">
        <div class="container">
            <div class="row">
                <div class="col l-3 m-6 c-12 shipping-wrapper">
                    <i class="shipping-icon fas fa-car"></i>
                    <div class="shipping-content">
                        <span class="size-18">Free Delivery</span>
                        <p>On all Orders over $99</p>
                    </div>
                </div>
                <div class="col l-3 m-6 c-12 shipping-wrapper">
                    <i class="shipping-icon fas fa-sync-alt"></i>
                    <div class="shipping-content">
                        <span class="size-18">90 Days Return</span>
                        <p>If goods have problems</p>
                    </div>
                </div>
                <div class="col l-3 m-6 c-12 shipping-wrapper">
                    <i class="shipping-icon far fa-address-card"></i>
                    <div class="shipping-content">
                        <span class="size-18">100% Safe & Secure</span>
                        <p>Proin condimentum sagittis</p>
                    </div>
                </div>
                <div class="col l-3 m-6 c-12 shipping-wrapper">
                    <i class="shipping-icon far fa-life-ring"></i>
                    <div class="shipping-content">
                        <span class="size-18">100% Safe & Secure</span>
                        <p>Proin condimentum sagittis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="display: none; height: 150px; width: 360px; background: white; 
    position: fixed; bottom: 20px; left: 20px; z-index: 100; opacity: 0; transition: 1s ease;"  id="notification">
        <img src="" id="notification_product_image" style="width: 150px; height: 150px">
        <div class="asd" style="font-size: 14px; padding: 30px 10px;">
            <p>Someone purchased a<p>
            <p id="notification_product_name"></p>
            <p id="notification_time_buy"></p>
            <p>
                <a  id="qwe123"onclick="notification_link()" style="color: blue; cursor: pointer">
                    View
                </a>
            </p>
        </div>
    </div>
    @php
        function addToWishList($productId) {
            if(Session::has('customer')) {
                return route('WishListController.addToWishList', ['customer_id' => Session::get('customer')['id'], 'product_id' => $productId ]);
            }
            return route('frontend.login');
        }
    @endphp
    <style>
        .asd p{
            padding: 3px;
        }
    </style>
    <script>
        var link = '';
        window.Echo.channel('EventTriggered')
        .listen('NotificationOrder', (e) => {
            var n = Date.now();
            var getTime = Math.floor(n/1000) +1 - e.timeBuyProduct;
            document.getElementById("notification").style.display = 'flex';
            document.getElementById("notification").style.opacity = '1';
            document.getElementById("notification_product_name").innerHTML = e.productName;
            document.getElementById("notification_product_image").src = e.productImage;
            if(getTime<60) {
                document.getElementById("notification_time_buy").innerHTML = getTime + " giây trước";
            } else if(getTime<3600 ) {
                var getTime = Math.floor(getTime/60)
                document.getElementById("notification_time_buy").innerHTML = getTime + " phút trước";
            } else {
                var getTime = Math.floor(getTime/3600)
                document.getElementById("notification_time_buy").innerHTML = getTime + " giờ trước";
            }
            this.link = e.productLink;
            setTimeout(function(){
                document.getElementById("notification").style.opacity = '0'
            }, 6000);
        })
        function notification_link() {
            location.href = this.link;
        }
    </script>
</main>

@endsection