
    <div class="header-container ">
        
        <!-- Header middle-bar -->
        <div class="grid wide header-middle">
            <div class="row container header-middle__container">
                <a href="{{ route('homeFrontend.index') }}" class="header-logo">
                    <h1 style="font-size: 50px; color:pink;">SERAWI</h1>
                </a>
                <!-- Search -->
                <div class="header-search" >
                    <div class="header-search-container">
                        <div class="header-search__block-search">
                            <div class="block-search__content">
                                <i class="search-icon fas fa-search"></i>
                                <div class="search-field">
                                    <div class="search-field__control">
                                        <input type="text" onkeyup="smartSearch()" id="key" class="search-field__input-text" autocomplete="off" placeholder="Nhập tên sản phẩm muốn tìm...">
                                        <div class="search-field__control__search-suite" style="margin-left: -25px;">
                                            <!-- Search suggest -->
                                            <!-- Remove class 'hidden' to display -->
                                            <div class="search-suggest hidden" id="showSmartSearch" style="width: 750px">
                                                <div class="search-suggest__container">
                                                    <div class="search-suggest__heading">
                                                        <span>Sản phẩm tìm được</span>
                                                        <a href=""class="search-suggest__see-all">
                                                            <span>See all</span>    
                                                        </a>
                                                    </div>
                                                    <div class="search-suggest__product" id="asdqwe123">
                                                        <ul class="search-suggest__product__list">
                                                           
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-field__action">
                                        <button class="search-field__action-btn" onclick="search()">
                                            <span>Search</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            function search() {
                                let key = document.getElementById('key').value;
                                let routeName = '{{ route("categoryFrontend.searchProduct", ":key") }}';
                                routeName = routeName.replace(':key', key);
                                location.href = routeName;
                            }

                            document.addEventListener("click", function(evt) {
                                document.getElementById('showSmartSearch').classList.add("hidden");
                            }); 

                            function smartSearch() {
                                let key = document.getElementById('key').value;
                                if(key != "") { 
                                    document.getElementById('showSmartSearch').classList.remove("hidden");
                                    let routeName = '{{ route("productFrontend.smartSearch", ":key") }}';
                                    routeName = routeName.replace(':key', key);
                                    $.ajax({
                                    url: routeName,
                                    success: function( result ) {
                                        $( "#asdqwe123 ul" ).empty();
                                        $( "#asdqwe123 ul" ).append(result);
                                    }
                                    });
                                } else { 
                                    document.getElementById('showSmartSearch').classList.add("hidden");
                                }

                                $("#key").keypress(function(event){
                                    if(event.keyCode == 13){
                                        $("#keyBtn").click();
                                    }
                                });
                            }
                          </script>
                        <div class="header-search__search-key">
                            <ul class="search-key__list" style="width: 800px">
                                @foreach ($listHotCategory as $hotCategory)
                                    <li class="search-key__item">
                                        <a href="{{ route('categoryFrontend.sortFollowCategoryName', [$hotCategory->id]) }}" class="search-key__link">
                                            @php
                                                echo $hotCategory->name;
                                            @endphp
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="header-action">
                    <div class="header-action__wish-list">
                        <i class="header-action__wish-list-icon header-icon far fa-heart"></i>
                        <span class="cart__count">
                            @php
                                if(Session::has('wish_list')){
                                    echo count(Session::get('wish_list'));
                                } else {
                                    echo 0;
                                }
                            @endphp
                        </span>
                    </div>
                    <!-- Cart -->
                    <div class="header-action__cart">
                        <div class="header-action__cart-header">
                            <i class="header-action__cart-icon header-icon fas fa-shopping-cart"></i>
                            <span class="cart__count">
                                @php
                                    if(Session::has('carts')){
                                        echo count(Session::get('carts'));
                                    } else {
                                        echo 0;
                                    }
                                @endphp
                            </span>
                        </div>

                        <div class="header-action__cart-list">
                            <div class="header-cart-list-wrapper">
                                <div class="close-btn header-cart-list__close-btn">
                                    <i class="ti-close"></i>
                                </div>
                                <!-- Cart has no item -->
                                @if (Session::has('carts'))
                                    <div class="header-cart-has-items">
                                        <div class="header-cart-has-items__wrapper">
                                            <ol class="header-cart__list">
                                                @php
                                                    $totalPirce = 0;
                                                @endphp
                                                @foreach (Session::get('carts') as $cart)
                                                    @php
                                                        $totalPirce +=($cart['product']['price'] - ($cart['product']['price']*$cart['product']['discount'])/100)*$cart['quantity'];
                                                    @endphp
                                                    <li class="header-cart__item">
                                                        <div class="header-cart__item-img">
                                                            @php
                                                                $cartImages = explode('|', $cart['product']['image']);
                                                            @endphp
                                                            <img src="{{ asset('uploads/'.$cartImages[0]) }}" alt="">
                                                        </div>
                                                        <div class="header-cart__item-detail">
                                                            <a href="{{ route('productFrontend.index', [$cart['product']['id']]) }}" class="item-detail__name">{{ $cart['product']['name'] }}</a>
                                                            <div class="item-detail__pricing">
                                                                <div class="item-detail__price-container">{{ number_format(ceil($cart['product']['price'] - ($cart['product']['price']*$cart['product']['discount'])/100)) }} VND</div> 
                                                                <i class="qty-mul-icon ti-close"></i>
                                                                <div class="item-detail__qty">{{ $cart['quantity'] }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="header-cart__item-action">
                                                            <div class="item-action__primary">
                                                                <a href="" class="item-action__primary-link">
                                                                    <i class="ti-close"></i>
                                                                </a>
                                                            </div>
                                                            <div class="item-action__secondary">
                                                                <a href="" class="item-action__secondary-link">
                                                                    <i class="fas fa-cog"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div>
                                        @endforeach
                                        <div class="header-cart-has-items__subtotal">
                                            <span class="items__subtotal__label">Cart Subtotal</span>
                                            <div class="items__subtotal__price">{{ number_format(ceil($totalPirce)); }} VND</div>
                                        </div>
                                        <div class="header-cart-has-items__action">
                                            <a href="{{ route('cart.index') }}" class="btn-primary items__action__view-card">Giỏ hàng</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="header-cart-no-item__msg">Bạn không có sản phẩm nào trong giỏ hàng.</div>
                                @endif
                                <!-- Cart has items -->
                            </div>
                        </div>

                        <div class="header-action__wish-header">
                            <div class="header-cart-list-wrapper">
                                <div class="close-btn123 header-cart-list__close-btn">
                                    <i class="ti-close"></i>
                                </div>
                                @if (Session::has('wish_list'))
                                    <div class="header-cart-has-items">
                                        <div class="header-cart-has-items__wrapper">
                                            <ol class="header-cart__list">
                                                @php
                                                    $totalPirce = 0;
                                                @endphp
                                                @foreach (Session::get('wish_list') as $wishList)
                                                    @php
                                                        $totalPirce += $wishList['product']['price']- ($wishList['product']['price']*$wishList['product']['discount'])/100;
                                                    @endphp
                                                    <li class="header-cart__item">
                                                        <div class="header-cart__item-img">
                                                            @php
                                                                $wishListImage = explode('|', $wishList['product']['image']);
                                                            @endphp
                                                            <img src="{{ asset('uploads/'.$wishListImage[0]) }}" alt="">
                                                        </div>
                                                        <div class="header-cart__item-detail">
                                                            <a href="{{ route('productFrontend.index', [$wishList['product']['id']]) }}" class="item-detail__name">{{ $wishList['product']['name'] }}</a>
                                                            <div class="item-detail__pricing">
                                                                <div class="item-detail__price-container">{{ number_format(ceil($wishList['product']['price'] - ($wishList['product']['price']*$wishList['product']['discount'])/100)) }} VND</div> 
                                                                <i class="qty-mul-icon ti-close"></i>
                                                                <div class="item-detail__qty">1</div>
                                                            </div>
                                                        </div>
                                                      
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>

                                        
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    <div class="header-action__account">
                        <div class="header-action__account-icon">
                            <i class="far fa-user-circle"></i>
                        </div>
                        <div class="header-action__account-wrap">
                            @if (Session::has('customer'))
                            <a class="account__link">
                                {{ Session::get('customer')['name']; }}
                            </a>
                            <a href="{{ route('frontend.logout') }}" class="account__link">
                                Đăng xuất
                            </a>
                            
                            @else
                                <a href="{{ route('frontend.login') }}"class="account__link">
                                    Đăng nhập
                                </a>
                                <a href="{{ route('frontend.register') }}" class="account__link">
                                    Đăng ký
                                </a>
                            @endif
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (!isset($displayListCategory))
            <style>
                .vertical-menu-category__list {
                    visibility: hidden;
                }
            </style>
        @endif
       
        <!-- Header content -->
        <div class="grid wide header-content">
            <div class="row container header-content__container">
                <div class="col l-2 m-3 vertical-menu">
                    <div class="grid wide vertical-menu__wrapper">
                        <nav class="row vertical-menu-category">
                            <h3  class="vertical-menu-category__title">
                                <i class="ti-menu-alt"></i>
                                <span>Danh mục sản phẩm</span>
                            </h3>
                            <ul class="col l-12 vertical-menu-category__list">
                                <h3 class="mobile-primary-menu__title">
                                    <span>Danh mục sản phẩm</span>
                                    <i class="close-btn ti-close" id="close-category"></i>
                                </h3>
                                @foreach ($listCategory as $category)
                                    <li class="vertical-menu-category__item">
                                        <a href="{{ route('categoryFrontend.sortFollowCategoryName', [$category->id]) }}" class="vertical-menu-category__link">
                                            <i class="vertical-munu-category__link-icon fas fa-tablet-alt"></i>
                                            {{ $category->name; }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>

                    </div>
                </div>
                <i class="ti-menu menu-icon"></i>
                <nav class="col l-7 m-4 primary-menu menu-wrapper">
                    <ul class="primary-menu__list">
                        <h3 class="mobile-primary-menu__title">
                            <span>Menu</span>
                            <i class="close-btn ti-close" id="close-menu"></i>
                        </h3>
                        <li class="primary-menu__item">
                            <a href="{{ route('homeFrontend.index') }}" class="primary-menu__link page-current">Trang chủ</a>
                        </li>
                    </ul>
                </nav>
                <div class="col l-3 m-5 header-content__action">
                    <div class="hotline">
                        <span class="hotline-title">Hotline: </span>
                        <a class="hotline-number">(+800) 1234 56789</a>
                    </div>
                
            </div>
        </div>
    </div>