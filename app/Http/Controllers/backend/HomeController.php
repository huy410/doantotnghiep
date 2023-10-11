<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    
    public function index() 
    {
        $statistics = DB::table('orders')
            ->selectRaw('created_at, SUM(total_price) as total_money, count(id) as total_order')
            ->where('created_at','>=',Carbon::now()->subdays(6))
            ->groupBy('created_at')
            ->get();
        
        $categories = DB::table('products')
            ->join('order_detail', 'products.id', '=', 'order_detail.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->selectRaw('sum(quantity) as orderQuantity, categories.name, sum(order_detail.price) as totalMoney')
            ->groupBy('category_id')
            ->orderByDesc('orderQuantity')
            ->take(4)
            ->get();

        $sumOrderQuantity = DB::table('order_detail')
            ->selectRaw('sum(quantity) as orderQuantity, sum(order_detail.price) as totalMoney')
            ->first();

        return view('admin/homeView', compact('statistics', 'categories', 'sumOrderQuantity'));
    }
}
