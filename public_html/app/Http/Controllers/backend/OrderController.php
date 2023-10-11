<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Events\newOrder;
use Exception;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderByDesc('created_at')->orderByDesc('created_at')->paginate(20);
        return view('admin.order.ordersView',['orders' => $orders]);
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->first();
        $orderDetail = OrderDetail::where('order_id', $id)->get();
        return view('admin.order.OrdersDetailView',['orderDetail' => $orderDetail, 'order' => $order]);
    }

    public function delivery($id)
    {
        try {
            Order::findOrFail($id)->update([
                'ship_status' => 1,
            ]);
            return redirect(route('orders.index'));
        } catch (Exception $e) {
            return $e;
        } 
    }

    public function payment($id)
    {
        try {
            Order::findOrFail($id)->update([
                'payment_status' => 1,
            ]);
            return redirect(route('orders.index'));
        } catch (Exception $e) {
            return $e;
        } 
    }
}
