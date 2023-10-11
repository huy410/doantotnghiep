@extends('frontend.layout')
@section('content')
        <main class="page-shop">
            <!-- Breadcrumbs -->
            <div class="breadcrumbs">
                <ul class="breadcrumbs-list grid wide">
                    <li class="breadcrumbs-item">
                        <a href="{{ route('homeFrontend.index') }}" class="breadcrumbs-link">Trang chủ</a>
                    </li>
                </ul>
            </div>
            <div class="grid wide container mg-bot-30">
                <div class="main-content">
                    <div class="row">
                        <div class="not-pc">
                            <i class="fas fa-filter filter-icon"></i>
                        </div>
                        <!-- Sidebar -->
                        <div class="col l-3 m-0 c-0 sidebar">
                            <div class="sidebar-main">
                                <div class="block filter">
                                    <div class="block-title filter-title">
                                    </div>
                                    <div class="block-content filter-content">
                                        <div class="block-subtitle filter-subtitle">Bộ lọc</div>
                                        <div class="filter-options">
                                            <div class="filter-options-item">
                                                <div class="filter-options-title" style="padding-bottom: 7px;">Khoảng giá</div>
                                                <div class="filter-options-content">
                                                     @if (!empty($sort))
                                                        <ul class="filter-options-content__list">
                                                            <li class="filter-options-content__item">
                                                                <a href="{{ route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'sortByPrice' => $sort, 'priceFrom' => '0', 'priceTo' => '5000000', 'brand' => $brand]) }}" id="priceFilter1" class="filter-options-content__link">
                                                                    <span class="price">0</span>
                                                                    -
                                                                    <span class="price">5.000.000 VND</span>
                                                                </a>
                                                            </li>
                                                            <li class="filter-options-content__item">
                                                                <a href="{{ route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'sortByPrice' => $sort, 'priceFrom' => '5000000', 'priceTo' => '10000000', 'brand' => $brand]) }}" id="priceFilter2" class="filter-options-content__link">
                                                                    <span class="price">5.000.000</span>
                                                                    -
                                                                    <span class="price">10.000.000 VND</span>
                                                                </a>
                                                            </li>
                                                            <li class="filter-options-content__item">
                                                                <a href="{{ route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'sortByPrice' => $sort, 'priceFrom' => '10000000', 'priceTo' => '15000000', 'brand' => $brand]) }}" id="priceFilter3" class="filter-options-content__link">
                                                                    <span class="price">10.000.000</span>
                                                                    -
                                                                    <span class="price">15.000.000 VND</span>
                                                                </a>
                                                            </li>
                                                            <li class="filter-options-content__item">
                                                                <a href="{{ route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'sortByPrice' => $sort, 'priceFrom' => '15000000', 'brand' => $brand]) }}" id="priceFilter4" class="filter-options-content__link">
                                                                    lớn hơn 
                                                                    <span class="price">15.000.000 VND</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    @else
                                                        <ul class="filter-options-content__list">
                                                            <li class="filter-options-content__item">
                                                                <a href="{{ route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'priceFrom' => '0', 'priceTo' => '5000000', 'brand' => $brand]) }}" id="priceFilter1" class="filter-options-content__link">
                                                                    <span class="price">0</span>
                                                                    -
                                                                    <span class="price">5.000.000 VND</span>
                                                                </a>
                                                            </li>
                                                            <li class="filter-options-content__item">
                                                                <a href="{{ route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'priceFrom' => '5000000', 'priceTo' => '10000000', 'brand' => $brand]) }}" id="priceFilter2" class="filter-options-content__link">
                                                                    <span class="price">5.000.000</span>
                                                                    -
                                                                    <span class="price">10.000.000 VND</span>
                                                                </a>
                                                            </li>
                                                            <li class="filter-options-content__item">
                                                                <a href="{{ route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'priceFrom' => '10000000', 'priceTo' => '15000000', 'brand' => $brand]) }}" id="priceFilter3" class="filter-options-content__link">
                                                                    <span class="price">10.000.000</span>
                                                                    -
                                                                    <span class="price">15.000.000 VND</span>
                                                                </a>
                                                            </li>
                                                            <li class="filter-options-content__item">
                                                                <a href="{{ route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'priceFrom' => '15000000', 'brand' => $brand]) }}" id="priceFilter4" class="filter-options-content__link">
                                                                    lớn hơn 
                                                                    <span class="price">15.000.000 VND</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    @endif
                                                    @if ($priceTo == 5000000)
                                                        <script>
                                                            document.getElementById("priceFilter1").classList.add("active");
                                                        </script>
                                                    @endif
                                                    @if ($priceFrom == 5000000)
                                                        <script>
                                                            document.getElementById("priceFilter2").classList.add("active");
                                                        </script>
                                                    @endif
                                                    @if ($priceFrom == 10000000)
                                                        <script>
                                                            document.getElementById("priceFilter3").classList.add("active");
                                                        </script>
                                                    @endif
                                                    @if ($priceFrom == 15000000)
                                                        <script>
                                                            document.getElementById("priceFilter4").classList.add("active");
                                                        </script>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sidebar-addition">
                                <div class="block block-compare">
                                    <div class="block-title">Nhãn hàng</div>
                                    <div class="filter-options-content">
                                        <ul class="filter-options-content__list">
                                            @foreach ($listBrands as $listBrand)
                                                <li class="filter-options-content__item">
                                                    <a href="{{ route('categoryFrontend.searchProduct' , [
                                                        'productName' => $productName, 
                                                        'brand' =>  $listBrand->brand
                                                    ]) }}" 
                                                    id="priceFilter1" class="filter-options-content__link">
                                                        {{ $listBrand->brand }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="block block-wishlist">
                                    <div class="block-title">Danh mục yêu thích</div>
                                    <div class="empty">You have no items in your wish list.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col l-9 m-12 c-12 col-main">
                            <!-- Filter -->
                            <div class="toolbar toolbar-products">
                                <div class="modes">
                                    <strong class="modes-mode active">
                                        <i class="fas fa-th"></i>
                                    </strong>
                                </div>
                                <p class="toolbar-amount">Sản phẩm từ
                                    <span class="toolbar-number">
                                        {{ ($getPaginateProduct->currentPage()-1) * $getPaginateProduct->perPage() + 1 }}
                                    </span>
                                    -
                                    <span class="toolbar-number">
                                        @if ($getPaginateProduct->lastPage() > 1)
                                            {{ ($getPaginateProduct->currentPage()-1) * $getPaginateProduct->perPage() + 1 + $getPaginateProduct->perPage() }} 
                                        @else
                                             {{ count($getPaginateProduct) }}
                                        @endif
                                       
                                    </span>
                                    of
                                    <span class="toolbar-number">
                                        {{ count($getPaginateProduct) }}
                                    </span>
                                </p>
                                <div class="toolbar-sorter sorter">
                                    <label for="" class="sorter-label">Sắp xếp theo</label>
                                    @if (!empty($sort))
                                        @if ($sort == 'asc')
                                            <select class="sorter-options" onchange="sort()" id="sort">
                                                <option id="asc" selected value="asc">Giá từ thấp đến cao</option>
                                                <option id="desc" value="desc">Giá từ cao đến thấp</option>
                                            </select>
                                        @else
                                            <select class="sorter-options" onchange="sort()" id="sort">
                                                <option id="asc" value="asc">Giá từ thấp đến cao</option>
                                                <option id="desc" selected value="desc">Giá từ cao đến thấp</option>
                                            </select>
                                        @endif
                                    @else
                                        <select class="sorter-options" onchange="sort()" id="sort">
                                            <option selected="selected">Giá</option>
                                            <option id="asc" value="asc">Giá từ thấp đến cao</option>
                                            <option id="desc" value="desc">Giá từ cao đến thấp</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <div>
                            </div>
                            {{-- @if ($priceFrom >= 0) --}}
                            <script>
                                function sort() {
                                    var sort = document.getElementById("sort").value;
                                    if(sort == 'desc'){
                                        let trashPHP = "{{ route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'sortByPrice' =>'desc', 'priceFrom' => $priceFrom, 'priceTo' => $priceTo, 'brand' => $brand]) }}"
                                        let del_trash_php=trashPHP.replace(/amp;/g, '');
                                        location.href = del_trash_php;
                                    } else {
                                        let trashPHP = "{{ route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'sortByPrice' =>'asc', 'priceFrom' => $priceFrom, 'priceTo' => $priceTo , 'brand' => $brand]) }}"
                                        let del_trash_php=trashPHP.replace(/amp;/g, '');
                                        location.href = del_trash_php;
                                    }
                                }
                            </script>
                            {{-- @else
                                <script>
                                    function sort() {
                                        var sort = document.getElementById("sort").value;
                                        if(sort == 'desc'){
                                            location.href =  "{{route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'sortByPrice' =>'desc', 'brand' => $brand])}}"
                                        } else {
                                            location.href =  "{{route('categoryFrontend.searchProduct' ,  ['productName' => $productName, 'sortByPrice' =>'asc', 'brand' => $brand])}}"
                                        }
                                    
                                    }
                                </script>
                            @endif --}}
                          
                            
                            <!-- 4 col -->
                            <div class="product-grid ">
                                <div class="grid">
                                    <ul class="row product-list">
                                        @foreach ($getPaginateProduct as $product)
                                            <li class="col l-3 m-4 c-6 product-wrapper">
                                                <div class="product-img">
                                                    @php
                                                        $productImg = explode('|', $product->image)
                                                    @endphp
                                                    <img src="{{ asset('uploads/'.$productImg[0]) }}" alt="">
                                                </div>
                                                <div class="product-action">
                                                    <a href="{{ route('cart.quickAddToCart', ['id'=> $product->id] ) }}"><i class="add-to-cart fas fa-cart-plus"></i></a>
                                                    <a href=""><i class="add-to-wish-list far fa-heart"></i></a>
                                                </div>
                                                <a href="{{ route('productFrontend.index', [$product->id]) }}" class="product-name">{{ $product->name }}</a>
                                                <div class="product-review-summary">
                                                    <div class="rating-result">
                                                        <i class="rating-icon active far fa-star"></i>
                                                        <i class="rating-icon active far fa-star"></i>
                                                        <i class="rating-icon active far fa-star"></i>
                                                        <i class="rating-icon active far fa-star"></i>
                                                        <i class="rating-icon active far fa-star"></i>
                                                    </div>
                                                    <div class="rating-action">
                                                        <a class="action-view">
                                                            1
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-price">
                                                    <div class="price-final">
                                                        {{ number_format(ceil($product->price - ($product->price*$product->discount)/100)) }} VND
                                                    </div>
                                                    <div class="price-old">{{ number_format($product->price) }} VND</div>
                                                </div>
                                                <span class="onsale">
                                                    <span>-{{ $product->discount }}%</span>
                                                </span>
                                            </li>
                                        @endforeach
                                       
                                        
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="toolbar toolbar-products bg-white">
                                <div class="pages">
                                    <ul class="pages-list">
                                        <li class="page-item page-next">
                                            <a href="{{ $getPaginateProduct->previousPageUrl() }}" class="action next">
                                                <span class="page">
                                                    <i class="ti-angle-left"></i>
                                                </span>
                                            </a>
                                        </li>
                                        @if ($getPaginateProduct->currentPage() != 1 && ($getPaginateProduct->currentPage()-2) > 1)
                                            <li class="page-item">
                                                <a href="{{ $getPaginateProduct->url(1) }}" class="page">1</a>
                                            </li>
                                            <li class="page-item">
                                                <span class="page">...</span>
                                            </li>  
                                        @endif
                                        @for ($i = 1; $i <= $getPaginateProduct->lastPage(); $i++)
                                            @if ($i == $getPaginateProduct->currentPage())
                                                <li class="page-item current">
                                                    <span class="page">{{ $i }}</span>
                                                </li>
                                            @else
                                                @if ($i >= ($getPaginateProduct->currentPage()-2) && $i <= ($getPaginateProduct->currentPage()+2))
                                                    <li class="page-item">
                                                        <a href="{{ $getPaginateProduct->url($i) }}" class="page">{{ $i }}</a>
                                                    </li>
                                                @endif
                                                    
                                            @endif
                                        @endfor
                                        @if ($getPaginateProduct->currentPage() != $getPaginateProduct->lastPage() && ($getPaginateProduct->currentPage()+2) < $getPaginateProduct->lastPage())
                                            <li class="page-item">
                                                <span class="page">...</span>
                                            </li>   
                                            <li class="page-item">
                                                <a href="{{ $getPaginateProduct->url($getPaginateProduct->lastPage()) }}" class="page">{{ $getPaginateProduct->lastPage() }}</a>
                                            </li>
                                        @endif

                                        <li class="page-item page-next">
                                            <a href="{{ $getPaginateProduct->nextPageUrl() }}" class="action next">
                                                <span class="page">
                                                    <i class="ti-angle-right"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @endsection