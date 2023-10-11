<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ThongKe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ThongKeController extends Controller
{
    public function index()
    {
        $getThongKes =  DB::table('orders')
        ->select([DB::raw('count(DISTINCT customer_id) as total_customer'), DB::raw('count(id) as total_order'), DB::raw('sum(total_price) as total_money'), 'created_at'])->groupBy('created_at')->get();
        return view('admin.order.ThongKeView', ['getThongKes' => $getThongKes]);
    }
    public function search(Request $request)
    {
        $getThongKes = DB::table('orders')
        ->select([DB::raw('count(DISTINCT customer_id) as total_customer'), DB::raw('count(id) as total_order'), DB::raw('sum(total_price) as total_money'), 'created_at'])->whereBetween('created_at', [$request->date1, $request->date2])->groupBy('created_at')->get();
        return view('admin.order.ThongKeView', ['getThongKes' => $getThongKes]);
    }
}
