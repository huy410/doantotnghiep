<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $displayListCategory = 1;
        $listCategory = Category::get(['id', 'name']);

        $hotProducts = OrderDetail::popular()->with('product')->take(4)->get();

        $bestWeekProduct = OrderDetail::whereBetween('created_at', [date('Y-m-d', strtotime(now()) - 86400*7), date('Y-m-d', strtotime(now()) + 86400)])->with('product')->popular()->take(3)->get();

        $bestDayProduct = OrderDetail::whereBetween('created_at', [date('Y-m-d', strtotime(now()) - 86400), date('Y-m-d', strtotime(now()) + 86400)])->with('product')->popular()->take(3)->get();
        
        $bestSellProduct = isset($hotProducts[0]) ? $hotProducts[0] : [];

        $mostDiscountProducts = Product::orderByDesc('discount')->take(3)->get();

        $showHotProducts = Product::where('display_home', true)->orderBy('id')->withCount('review')->withAvg('review', 'total_star')->take(7)->get();

        $newArrayProducts = Product::where('display_home', true)->orderBy('created_at')->take(5)->get();

        $listHotCategory = Category::where('display_home', true)->orderByDesc('display_home')->with('product')->take(6)->get();

        Session::put('taskUrl', request()->fullUrl());
        
        return view('frontend.home',[
            'displayListCategory' => $displayListCategory,
            'listCategory' => $listCategory, 
            'hotProducts' => $hotProducts,
            'bestSellProduct' => $bestSellProduct,
            'mostDiscountProducts' => $mostDiscountProducts,
            'showHotProducts' => $showHotProducts,
            'newArrayProducts' => $newArrayProducts,
            'listHotCategory' => $listHotCategory,
            'bestWeekProduct' => $bestWeekProduct,
            'bestDayProduct' => $bestDayProduct
        ]);
    }
}
