@extends('frontend.layout')
@section('content')
        <div class="breadcrumbs">
            <ul class="breadcrumbs-list grid wide">
                <li class="breadcrumbs-item">
                    <a href="{{ route('homeFrontend.index') }}" class="breadcrumbs-link">Trang chủ</a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="{{ route('productFrontend.index', [$product->id]) }}" class="breadcrumbs-link">
                        {{ $product->name }}
                    </a>
                </li>       
            </ul>
        </div>
        <!-- Main content - start -->
        <main class="page-main bg-white mg-bot-60">
            <div class="grid wide container">
                <div class="row product-main-content">
                    <div class="col l-6 m-12 c-12 product-media">
                        <div class="media-nav">
                            @if	(isset($product->image))
                                @php
                                    $images = explode('|', $product->image);
                                @endphp
                                 @php
                                    $imgI = 0;
                                @endphp
                                @foreach ($images as $image)
                                    @php
                                        $imgI++;
                                    @endphp
                                    <div class="media-nav-item media-nav-item">
                                        <img src="{{ asset('uploads/'.$image) }}" onclick="a({{ $imgI }})" id="qwe{{ $imgI }}">
                                    </div>
                                @endforeach
						    @endif
                        </div>
                        <div class="media-stage">
                            <img src="{{ asset('uploads/'.$images[0]) }}" id="qwe123" style="width: 500px; height: 500px;">
                        </div>
                        <script>
                            function a(i) {
                               document.getElementById("qwe123").src = document.getElementById("qwe"+i).src
                            }
                        </script>
                    </div>
                    <div class="col l-6 m-12 c-12 product-info-main">
                        <div class="product-title-wrapper">
                            <h1 class="product-title">
                                {{ $product->name }} 
                            </h1>
                        </div>
                        <div class="product-review-summary">
                            <div class="rating-result">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $totalStar)
                                        <i class="rating-icon active far fa-star"></i>
                                    @else
                                        <i class="rating-icon far fa-star"></i>
                                    @endif
                                @endfor 
                            </div>
                            <div class="reviews-actions">
                                <a class="action view">
                                    <span>{{ count($reviews) }}</span>
                                    <span>đánh giá</span>
                                </a>
                            </div>
                        </div>
                        <div class="share-dialog">
                        </div>
                        <div class="product-stock">
                            <span class="product-stock__title">Số lượng còn lại: </span>
                            <span class="product-stock__status">
                                 {{ $product->remaining }} 
                            </span>
                        </div>
                        <div class="product-description">
                            {{ $product->specifications }} 
                        </div>
                        <div class="product-info-price">
                            <span class="product-info-price-final">{{ number_format(ceil($product->price-($product->price*$product->discount)/100)) }} VND</span>
                            <span class="product-info-price-old">{{ number_format($product->price) }} VND</span>
                        </div>
                        <div class="product-add-form">
                            @if ($product->remaining > 0)
                                <form action="{{ route('cart.addToCart') }}" method="post">
                                    @csrf
                                    <div class="box-tocart">
                                        <div class="box-tocart__qty">
                                            <input type="hidden" value="{{ $product->id}}" name="productId">
                                            <a class="qty-down" onclick="minusQuantity()">
                                                <i class="fas fa-minus"></i>
                                            </a>
                                            <input type="number" class="qty-control" id="quantity" value="1" name="quantity" max="{{ $product->remaining }}"> 
                                            <a class="qty-up" onclick="plusQuantity()">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </div>
                                        <div class="box-tocart__action" style="width: 200px">
                                            <button type="submit"class="btn-primary">Cho vào giỏ hàng</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="box-tocart__action" style="width: 200px">
                                    <div class="btn-primary" style="background-color: gray">Hết hàng</div>
                                </div>
                            @endif
                            <script>
                                function plusQuantity() {
                                    if(document.getElementById("quantity").value < document.getElementById("quantity").max) {
                                        document.getElementById("quantity").value = +document.getElementById("quantity").value + 1 ;
                                    }
                                }
                                function minusQuantity() {
                                    if(document.getElementById("quantity").value > 1) {
                                        document.getElementById("quantity").value = +document.getElementById("quantity").value - 1 ;
                                    }
                                }
                            </script>
                        </div>
                        <div class="product-social-links">
                            <div class="product-addto-links">
                                <a href="{{ addToWishList( $product->id) }}" class="add-to-wish-list">
                                    <i class="far fa-heart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-category">
                            <label for="">Danh mục sản phẩm: </label>
                            <a href="{{ route('categoryFrontend.sortFollowCategoryName', ['categoryId'=>$product->category->id]) }}">{{ $product->category->name }}</a>
                        </div>
                        <div class="product-page-brand-common-view">
                            <label class="brand-label" for="">Thương hiệu: </label>
                            <a href="{{ route('categoryFrontend.searchProduct', ['brand'=>$product->brand]) }}">{{ $product->brand }}</a>
                        </div>
                    </div>
                </div>

                <div class="product-info-detail">
                    <div class="product-info-detail__tab-wrapper">
                        <div class="tab-heading">
                            <div class="tabs-item-wrapper">
                                <a onclick="informationTab(event, 'detail')" class="tab-item active">
                                    <span>Mô tả</span>
                                </a>
                                {{-- <a onclick="informationTab(event, 'moreInfor')" class="tab-item">
                                    <span>Chi tiết thông số</span>
                                </a> --}}
                                <a onclick="informationTab(event, 'review')" class="tab-item">
                                    <span>Đánh giá</span>
                                    <span class="counter">
                                        {{ count($reviews) }}
                                    </span>
                                </a>
                            </div>
                        </div>
                        
                        <div class="tab-content">
                            <!-- Detail -->
                            <div class="tab-pane" id="detail" style="width: 70%">
                                <div class="product-detail-description">
                                    {!! $product->description !!} 
                                </div>
                            </div>

                            <!-- More infomation -->
                            <!-- Remove class 'hidden' to display -->
                            {{-- <div class="tab-pane hidden" id="moreInfor">
                                <div class="product-detail-more-info">
                                       {!! $product->specifications !!} 
                                </div>
                            </div> --}}

                            <!-- Reviews -->
                            <!-- Remove class 'hidden' to display -->
                            <div class="tab-pane hidden" id="review">
                                <div class="block product-detail-review ">
                                    <div class="block-title">
                                        <span>Danh sách đánh giá</span>
                                    </div>
                                  
                                    <div class="block-content">
                                        <ul class="product-detail-review__list">
                                            @foreach ($reviews as $review)
                                                <li class="product-detail-review__item">
                                                    <div class="review-title">{{ $review->title }}</div>
                                                    <div class="review-content">
                                                        <div class="review-content-left">
                                                            <div class="review-ratings">
                                                                <div class="rating-summary-item">
                                                                    <div class="label rating-label">
                                                                        <span>Nhận xét về giá thành</span>
                                                                    </div>
                                                                    <div class="rating-result">
                                                                        @for ($i = 0; $i < 5; $i++)
                                                                            @if ($i < $review->price_review_star )
                                                                                <i class="rating-icon active far fa-star"></i>
                                                                            @else
                                                                                <i class="rating-icon far fa-star"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                                <div class="rating-summary-item">
                                                                    <div class="label rating-label">
                                                                        <span>Nhận xét về chất lượng</span>
                                                                    </div>
                                                                    <div class="rating-result">
                                                                        @for ($i = 0; $i < 5; $i++)
                                                                            @if ($i < $review->quality_review_star )
                                                                                <i class="rating-icon active far fa-star"></i>
                                                                            @else
                                                                                <i class="rating-icon far fa-star"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                                <div class="rating-summary-item">
                                                                    <div class="label rating-label">
                                                                        <span>Nhận xét về giao hàng</span>
                                                                    </div>
                                                                    <div class="rating-result">
                                                                        @for ($i = 0; $i < 5; $i++)
                                                                            @if ($i < $review->ship_review_star )
                                                                                <i class="rating-icon active far fa-star"></i>
                                                                            @else
                                                                                <i class="rating-icon far fa-star"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-content-right">
                                                            <div class="review-content-cmt">
                                                                {{ $review->review_detail }}
                                                            </div>
                                                            <div class="review-details">
                                                                <div class="review-author">
                                                                    <span class="review-details-label">Người nhận xét</span>
                                                                    <strong class="review-details-value">{{ $review->nick_name }}</strong>
                                                                </div>
                                                                <div class="review-date">
                                                                    <span class="review-details-label">Ngày nhận xét</span>
                                                                    <time class="review-details-value">{{ $review->created_at }}</time>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="block-review-add">
                                        <form action="{{ route('productFrontend.review', ['id'=>$product->id]) }}" class="review-form" method="post">
                                            @csrf
                                            <div class="review-form-title">
                                                <span>Bạn đang nhận xét sản phẩm:</span>
                                                <strong>{{ $product->name }}</strong>
                                            </div>
                                            <fieldset class=" fieldset required review-field-ratings">
                                                <div class="field required">
                                                    <div class="label">
                                                        <span>Nhận xét của bạn</span>
                                                    </div>
                                                </div>
                                                <div class="control">
                                                    <div class="product-review-table">
                                                        <div class="review-field-rating">
                                                            <label for="" class="label rating-label">
                                                                <div style="width: 170px">Nhận xét về giá thành: </div>
                                                            </label>
                                                            <div class="review-control-vote">
                                                                <div class="rating-result">
                                                                    <i class="rating-icon far fa-star" id="pricereviewstar1"></i>
                                                                    <i class="rating-icon far fa-star" id="pricereviewstar2"></i>
                                                                    <i class="rating-icon far fa-star" id="pricereviewstar3"></i>
                                                                    <i class="rating-icon far fa-star" id="pricereviewstar4"></i>
                                                                    <i class="rating-icon far fa-star" id="pricereviewstar5"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-field-rating">
                                                            <label for="" class="label rating-label">
                                                                <div style="width: 170px">Nhận xét về chất lượng: </div>
                                                            </label>
                                                            <div class="review-control-vote">
                                                                <div class="rating-result">
                                                                    <i class="rating-icon far fa-star" id="quantityreviewstar1"></i>
                                                                    <i class="rating-icon far fa-star" id="quantityreviewstar2"></i>
                                                                    <i class="rating-icon far fa-star" id="quantityreviewstar3"></i>
                                                                    <i class="rating-icon far fa-star" id="quantityreviewstar4"></i>
                                                                    <i class="rating-icon far fa-star" id="quantityreviewstar5"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-field-rating">
                                                            <label for="" class="label rating-label">
                                                                <div style="width: 170px">Nhận xét về giao hàng: </div>
                                                            </label>
                                                            <div class="review-control-vote">
                                                                <div class="rating-result">
                                                                    <i class="rating-icon far fa-star" id="shipreviewstar1"></i>
                                                                    <i class="rating-icon far fa-star" id="shipreviewstar2"></i>
                                                                    <i class="rating-icon far fa-star" id="shipreviewstar3"></i>
                                                                    <i class="rating-icon far fa-star" id="shipreviewstar4"></i>
                                                                    <i class="rating-icon far fa-star" id="shipreviewstar5"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <input type="hidden" id="getPricereviewstar" name="getPricereviewstar">
                                            <input type="hidden" id="getQualityreviewstar" name="getQualityreviewstar">
                                            <input type="hidden" id="getShipreviewstar" name="getShipreviewstar">
                                            <div class="field review-field-nickname required">
                                                <label for="" class="label">
                                                    <span>Tên của bạn</span>
                                                </label>
                                                <div class="control">
                                                    <input type="text" class="input-text" name="nick_name" id="">
                                                </div>
                                            </div>
                                            <div class="field review-field-summary required">
                                                <label for="" class="label">
                                                    <span>Tiêu đề nhận xét</span>
                                                </label>
                                                <div class="control">
                                                    <input type="text" class="input-text" name="title" id="">
                                                </div>
                                            </div>
                                            <div class="field review-field-text required">
                                                <label for="" class="label">
                                                    <span>Chi tiết</span>
                                                </label>
                                                <div class="control">
                                                    <textarea name="review_detail" id="" cols="5" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="review-form-actions">
                                                @if (Session::has("customer"))
                                                    <div class="actions-primary">
                                                        <button type="submit" class="btn-primary">Đánh giá</button>
                                                    </div>
                                                @else
                                                    <div class="actions-primary">
                                                        <a href="{{ route('frontend.login') }}" class="btn-primary">Đăng nhập để đánh giá</a>
                                                    </div>
                                                @endif
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function informationTab(evt, tab) {
                                    tabcontent = document.getElementsByClassName("tab-pane");
                                    tablinks = document.getElementsByClassName("tab-item");
                                    for (i = 0; i < tabcontent.length; i++) {
                                        tabcontent[i].classList.add("hidden");
                                    }
                                    for (i = 0; i < tablinks.length; i++) {
                                        tablinks[i].classList.remove("active");
                                    }
                                    document.getElementById(tab).classList.remove("hidden");
                                    evt.currentTarget.classList.add("active");
                                }
                                var pricereviewstar=new Array();
                                for(let i=1; i<=5;i++) {
                                    pricereviewstar[i] = document.getElementById("pricereviewstar"+i);
                                }
                                
                                for(let i=1; i<=5; i++) {
                                    pricereviewstar[i].onmousemove = function() {
                                        for(j=1; j<=5; j++) {
                                            if(j<=i) {
                                                pricereviewstar[j].classList.add("active");
                                            } else {
                                                pricereviewstar[j].classList.remove("active");
                                            }
                                            document.getElementById("getPricereviewstar").value = i;
                                        }
                                    }
                                }

                                 var quantityreviewstar=new Array();
                                for(let i=1; i<=5;i++) {
                                    quantityreviewstar[i] = document.getElementById("quantityreviewstar"+i);
                                }

                                for(let i=1; i<=5; i++) {
                                    quantityreviewstar[i].onmousemove = function() {
                                        for(j=1; j<=5; j++) {
                                            if(j<=i) {
                                                quantityreviewstar[j].classList.add("active");
                                            } else {
                                                quantityreviewstar[j].classList.remove("active");
                                            }
                                            document.getElementById("getQualityreviewstar").value = i;
                                        }
                                    }
                                }

                                var shipreviewstar=new Array();
                               for(let i=1; i<=5;i++) {
                                    shipreviewstar[i] = document.getElementById("shipreviewstar"+i);
                               }

                               for(let i=1; i<=5; i++) {
                                    shipreviewstar[i].onmousemove = function() {
                                       for(j=1; j<=5; j++) {
                                           if(j<=i) {
                                                shipreviewstar[j].classList.add("active");
                                           } else {
                                                shipreviewstar[j].classList.remove("active");
                                           }
                                           document.getElementById("getShipreviewstar").value = i;
                                       }
                                   }
                               }                   
                           </script>
                        </div>
                    </div>
                </div>

                <div class="product-relate">
                    <div class="tag-title__wrapper">
                        <div class="tag-title">
                            <h2>Sản phẩm tương tự</h2>
                            <div class="tag-title-action">
                                <a href="#" style="margin-right: 50px">
                                    Select All
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <ul class="row product-relate__list">
                            @foreach ($listSuggestProducts as $listSuggestProduct)
                            <li class="col l-2-4 m-4 c-6 product-wrapper">
                                <a href="" class="product-img">
                                    @php
                                        $imageSuggestProduct = explode('|', $listSuggestProduct->image);
                                    @endphp
                                    <img src="{{ asset('uploads/'.$imageSuggestProduct[0]) }}" alt="">
                                </a>
                                <div class="product-action">
                                    <a href="{{ addToWishList( $listSuggestProduct->id) }}"><i class="add-to-wish-list far fa-heart"></i></a>
                                    <a href="{{ route('cart.quickAddToCart', ['id'=> $listSuggestProduct->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                 </div>
                                <div class="onsale">
                                    <span>{{ $listSuggestProduct->discount; }}%</span>
                                </div>
                                <a href="{{ route('productFrontend.index', [$listSuggestProduct->id] ) }}" class="product-name">{{ $listSuggestProduct->name; }}</a>
                                <div class="product-price">
                                    <div class="price-final">{{ number_format(round($listSuggestProduct->price - ($listSuggestProduct->price*$listSuggestProduct->discount)/100)); }} VND</div>
                                    <div class="price-old">{{ number_format($listSuggestProduct->price); }} VND</div>
                                </div>
                            </li>
                            @endforeach
                          
                        </ul>
                    </div>
                </div>
            </div>
        </main>
        @php
            function addToWishList($productId) {
                if(Session::has('customer')) {
                    return route('WishListController.addToWishList', ['customer_id' => Session::get('customer')['id'], 'product_id' => $productId ]);
                }
                return route('frontend.login');
            }
        @endphp
        <!-- Main content - end -->

        <!-- --------------------------------------- -->


    </div>
@endsection