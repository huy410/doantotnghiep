<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function sortFollowCategoryName($categoryId, Request $request)
    {
        $sortByPrice = isset($request->sortByPrice) ? $request->sortByPrice : '';
        $priceFrom = isset($request->priceFrom) ? $request->priceFrom : (-1);
        $priceTo = isset($request->priceTo) ? $request->priceTo : '';
        $brand = isset($request->brand) ? $request->brand : '';
        $listCategory = Category::get();
        $listHotCategory = Category::where('display_home', true)->orderByDesc('display_home')->take(6)->get();
        $getCategories = Category::where('id', $categoryId)->first();
        $listBrands = Product::where('category_id', $categoryId)->groupBy('brand')->get('brand');
        Session::put('taskUrl', request()->fullUrl());

        if(!empty($brand)) {
            if(!empty($sortByPrice) && $priceFrom >= 0) {
                if(!empty($priceTo)) {
                    if($sortByPrice == 'desc') {
                        $getPaginateProduct = $getCategories->product()->where('brand', $brand)->whereBetween('price', [$priceFrom, $priceTo])
                        ->orderByDesc('price')->paginate(20)->appends([
                            'sortByPrice' => $sortByPrice,
                            'priceFrom' => $priceFrom,
                            'priceTo' => $priceTo,
                            'brand' => $brand
                        ]);
                        
                    } else {
                        $getPaginateProduct = $getCategories->product()->where('brand', $brand)->whereBetween('price', [$priceFrom, $priceTo])->orderBy('price')->paginate(20)->appends([
                            'sortByPrice' => $sortByPrice,
                            'priceFrom' => $priceFrom,
                            'priceTo' => $priceTo,
                            'brand' => $brand
                        ]);
                    }
                } else  {
                    if($sortByPrice == 'desc') {
                        $getPaginateProduct = $getCategories->product()->where('brand', $brand)->where('price', '>', $priceFrom)->orderByDesc('price')->paginate(20)->appends([
                            'sortByPrice' => $sortByPrice,
                            'priceFrom' => $priceFrom,
                            'priceTo' => $priceTo,
                            'brand' => $brand
                        ]);
                    } else {
                        $getPaginateProduct = $getCategories->product()->where('brand', $brand)->where('price', '>', $priceFrom)->orderBy('price')->paginate(20)->appends([
                            'sortByPrice' => $sortByPrice,
                            'priceFrom' => $priceFrom,
                            'priceTo' => $priceTo,
                            'brand' => $brand
                        ]);;
                    }
                }
            } else if($priceFrom >= 0) {
                if(!empty($priceTo)) {
                    $getPaginateProduct = $getCategories->product()->where('brand', $brand)->whereBetween('price', [$priceFrom, $priceTo])->paginate(20)->appends([
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo,
                        'brand' => $brand
                    ]);
                } else {
                    $getPaginateProduct = $getCategories->product()->where('brand', $brand)->where('price', '>', $priceFrom)->paginate(20)->appends([
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo,
                        'brand' => $brand
                    ]);
                }
            } else  if(!empty($sortByPrice)){
                if($sortByPrice == 'desc') {
                    $getPaginateProduct =  $getCategories->product()->where('brand', $brand)->orderByDesc('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'brand' => $brand
                    ]);
                } else {
                    $getPaginateProduct =  $getCategories->product()->where('brand', $brand)->orderBy('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'brand' => $brand
                    ]);
                }
            } else {
                $getPaginateProduct =  $getCategories->product()->where('brand', $brand)->orderBy('price')->paginate(20)->appends([
                    'brand' => $brand
                ]);
            }
        } else if(!empty($sortByPrice) && $priceFrom >= 0) {
            if(!empty($priceTo)) {
                if($sortByPrice == 'desc') {
                    $getPaginateProduct = $getCategories->product()->whereBetween('price', [$priceFrom, $priceTo])
                    ->orderByDesc('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo
                    ]);
                } else {
                    $getPaginateProduct = $getCategories->product()->whereBetween('price', [$priceFrom, $priceTo])->orderBy('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo
                    ]);
                }
            } else {
                if($sortByPrice == 'desc') {
                    $getPaginateProduct = $getCategories->product()->where('price', '>', $priceFrom)->orderByDesc('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo
                    ]);
                } else {
                    $getPaginateProduct = $getCategories->product()->where('price', '>', $priceFrom)->orderBy('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo
                    ]);;
                }
            }
        } else if($priceFrom >= 0) {
            if(!empty($priceTo)) {
                $getPaginateProduct = $getCategories->product()->whereBetween('price', [$priceFrom, $priceTo])->paginate(20)->appends([
                    'priceFrom' => $priceFrom,
                    'priceTo' => $priceTo
                ]);
            } else {
                $getPaginateProduct = $getCategories->product()->where('price', '>', $priceFrom)->paginate(20)->appends([
                    'priceFrom' => $priceFrom,
                    'priceTo' => $priceTo
                ]);
            }
        } else  if(!empty($sortByPrice)){
            if($sortByPrice == 'desc') {
                $getPaginateProduct =  $getCategories->product()->orderByDesc('price')->paginate(20)->appends([
                    'sortByPrice' => $sortByPrice,
                ]);
            } else {
                $getPaginateProduct =  $getCategories->product()->orderBy('price')->paginate(20)->appends([
                    'sortByPrice' => $sortByPrice,
                ]);
            }
        } else {
            $getPaginateProduct =  $getCategories->product()->paginate(20);
        }

        return view('frontend.shop', [
            'listCategory' => $listCategory,
            'listHotCategory' => $listHotCategory,
            'getCategories' => $getCategories,
            'getPaginateProduct' => $getPaginateProduct,
            'sort' => $sortByPrice,
            'priceFrom' => $priceFrom,
            'priceTo' => $priceTo,
            'listBrands' => $listBrands,
            'brand' => $brand
        ]);
    }

    public function searchProduct(Request $request, $productName = null)
    {
        $sortByPrice = isset($request->sortByPrice) ? $request->sortByPrice : '';
        $priceFrom = isset($request->priceFrom) ? $request->priceFrom : -1;
        $priceTo = isset($request->priceTo) ? $request->priceTo : '';
        $brand = isset($request->brand) ? $request->brand : '';

        $listCategory = Category::get();
        $listHotCategory = Category::where('display_home', true)->orderByDesc('display_home')->take(6)->get();
        $listProducts = Product::where('name', 'like', '%'.$productName.'%');
        $listBrands = Product::where('name', 'like', '%'.$productName.'%')->groupBy('brand')->get('brand');
        Session::put('taskUrl', request()->fullUrl());

        if(!empty($brand)) {
            if(!empty($sortByPrice) && $priceFrom >= 0) {
                if(!empty($priceTo)) {
                    if($sortByPrice == 'desc') {
                        $getPaginateProduct = $listProducts->where('brand', $brand)->whereBetween('price', [$priceFrom, $priceTo])
                        ->orderByDesc('price')->paginate(20)->appends([
                            'sortByPrice' => $sortByPrice,
                            'priceFrom' => $priceFrom,
                            'priceTo' => $priceTo,
                            'brand' => $brand
                        ]);
                    } else {
                        $getPaginateProduct = $listProducts->where('brand', $brand)->whereBetween('price', [$priceFrom, $priceTo])->orderBy('price')->paginate(20)->appends([
                            'sortByPrice' => $sortByPrice,
                            'priceFrom' => $priceFrom,
                            'priceTo' => $priceTo,
                            'brand' => $brand
                        ]);
                    }
                } else {
                    if($sortByPrice == 'desc') {
                        $getPaginateProduct = $listProducts->where('brand', $brand)->where('price', '>', $priceFrom)->orderByDesc('price')->paginate(20)->appends([
                            'sortByPrice' => $sortByPrice,
                            'priceFrom' => $priceFrom,
                            'priceTo' => $priceTo,
                            'brand' => $brand
                        ]);
                    } else {
                        $getPaginateProduct = $listProducts->where('brand', $brand)->where('price', '>', $priceFrom)->orderBy('price')->paginate(20)->appends([
                            'sortByPrice' => $sortByPrice,
                            'priceFrom' => $priceFrom,
                            'priceTo' => $priceTo,
                            'brand' => $brand
                        ]);;
                    }
                }
            } else if($priceFrom >= 0) {
                if(!empty($priceTo)) {
                    $getPaginateProduct = $listProducts->where('brand', $brand)->whereBetween('price', [$priceFrom, $priceTo])->paginate(20)->appends([
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo,
                        'brand' => $brand
                    ]);
                } else {
                    $getPaginateProduct = $listProducts->where('brand', $brand)->where('price', '>', $priceFrom)->paginate(20)->appends([
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo,
                        'brand' => $brand
                    ]);
                }
            } else  if(!empty($sortByPrice)){
                if($sortByPrice == 'desc') {
                    $getPaginateProduct =  $listProducts->where('brand', $brand)->orderByDesc('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'brand' => $brand
                    ]);
                } else {
                    $getPaginateProduct =  $listProducts->where('brand', $brand)->orderBy('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'brand' => $brand
                    ]);
                }
            } else {
                $getPaginateProduct =  $listProducts->where('brand', $brand)->orderBy('price')->paginate(20)->appends([
                    'brand' => $brand
                ]);
            }
        } else if(!empty($sortByPrice) && $priceFrom >= 0) {
            if(!empty($priceTo)) {
                if($sortByPrice == 'desc') {
                    $getPaginateProduct = $listProducts->whereBetween('price', [$priceFrom, $priceTo])
                    ->orderByDesc('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo
                    ]);
                } else {
                    $getPaginateProduct = $listProducts->whereBetween('price', [$priceFrom, $priceTo])->orderBy('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo
                    ]);
                }
            } else {
                if($sortByPrice == 'desc') {
                    $getPaginateProduct = $listProducts->where('price', '>', $priceFrom)->orderByDesc('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo
                    ]);
                } else {
                    $getPaginateProduct = $listProducts->where('price', '>', $priceFrom)->orderBy('price')->paginate(20)->appends([
                        'sortByPrice' => $sortByPrice,
                        'priceFrom' => $priceFrom,
                        'priceTo' => $priceTo
                    ]);;
                }
            }
        } else if($priceFrom >= 0) {
            if(!empty($priceTo)) {
                $getPaginateProduct = $listProducts->whereBetween('price', [$priceFrom, $priceTo])->paginate(20)->appends([
                    'priceFrom' => $priceFrom,
                    'priceTo' => $priceTo
                ]);
            } else {
                $getPaginateProduct = $listProducts->where('price', '>', $priceFrom)->paginate(20)->appends([
                    'priceFrom' => $priceFrom,
                    'priceTo' => $priceTo
                ]);
            }
        } else  if(!empty($sortByPrice)){
            if($sortByPrice == 'desc') {
                $getPaginateProduct =  $listProducts->orderByDesc('price')->paginate(20)->appends([
                    'sortByPrice' => $sortByPrice,
                ]);
            } else {
                $getPaginateProduct =  $listProducts->orderBy('price')->paginate(20)->appends([
                    'sortByPrice' => $sortByPrice,
                ]);
            }
        } else {
            $getPaginateProduct =  $listProducts->paginate(20);
        }

        return view('frontend.shop-copy', [
            'listCategory' => $listCategory,
            'listHotCategory' => $listHotCategory,
            'getPaginateProduct' => $getPaginateProduct,
            'sort' => $sortByPrice,
            'priceFrom' => $priceFrom,
            'priceTo' => $priceTo,
            'productName' => $productName,
            'listBrands' =>  $listBrands,
            'brand' => $brand
        ]);
    }
}
