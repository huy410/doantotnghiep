<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index($id)
    {
        $listCategory = Category::get();
        $listHotCategory = Category::where('display_home',true)->get();
        $product  = Product::where('id',$id)->first();
        $listSuggestProducts = Product::where('category_id', $product->category_id)->where('id', '<>' ,$product->id)->where('display_home',true)->take(5)->get();
        $reviews = Review::where('product_id', $id)->paginate(20);
        $totalStar = Review::where('product_id', $id)->avg('total_star');
        Session::put('taskUrl', request()->fullUrl());

        return view('frontend.product-detail',[
            'listCategory' => $listCategory,
            'listHotCategory' => $listHotCategory,
            'product' => $product,
            'listSuggestProducts' => $listSuggestProducts,
            'reviews' => $reviews,
            'totalStar' => $totalStar
        ]);
    }
    public function smartSearch($key)
    {
        $searchProducts  = Product::where('name','like','%'.$key.'%')->get();
        foreach($searchProducts as $searchProduct) {
            $images = explode('|', $searchProduct->image);
            echo '<li class="search-suggest__product__item">
                <a href="#" class="search-suggest__product__link">
                    <div class="search-suggest__img">
                        <a href="'.route("productFrontend.index", $searchProduct->id).'" class="search-suggest__img__link" alt="">
                            <img src="'.asset("uploads/".$images[0]).'" alt="">
                        </a>
                    </div>
                    <div class="search-suggest__info">
                        <div class="search-suggest__info__titile">
                            <a href="'.route("productFrontend.index", $searchProduct->id).'" class="search-suggest__info__titile-link">'. $searchProduct->name .'</a>
                        </div>
                        <div class="search-suggest__info__price">
                            <div class="special-price">'. number_format(ceil($searchProduct->price - ($searchProduct->price*$searchProduct->discount)/100)) .' VND</div>
                            <div class="old-price">'. number_format($searchProduct->price) .'</div>
                        </div>
                    </div>
                </a>
            </li>';
        }
    }
    public function review(Request $request, $id) {
        $nickName = $request->nick_name;
        $getPricereviewstar = $request->getPricereviewstar;
        $getQualityreviewstar = $request->getQualityreviewstar;
        $getShipreviewstar = $request->getShipreviewstar;
        $title = $request->title;
        $review_detail = $request->review_detail;
        Review::create([
            'nick_name' => $nickName,
            'price_review_star' => $getPricereviewstar,
            'quality_review_star' => $getQualityreviewstar,
            'ship_review_star' => $getShipreviewstar,
            'title' => $title,
            'review_detail' => $review_detail,
            'product_id' => $id,
            'customer_id' => Session::get('customer')->id,
            'total_star' => ($getPricereviewstar + $getQualityreviewstar + $getShipreviewstar)/3
        ]);
        return redirect(Session::get('taskUrl'));
    }
}
