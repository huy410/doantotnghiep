<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class StatusController extends Controller
{
    public function sell()
    {
        $orders = OrderDetail::where('refund', false)->paginate(20);
        return view('admin.status.sell',['orders' => $orders]);
    }

    public function sellToRefund($id)
    {
        OrderDetail::where('id', $id)->update([
            'refund' => true,
        ]);

        $orderDetail = OrderDetail::where('id', $id)->first();

        Product::where('id', $orderDetail->product_id)->update([
            'remaining' => $orderDetail->product->remaining + $orderDetail->quantity,
        ]);
        
        return redirect(route('StatusController.refund'));
    }

    public function refund()
    {
        $orders = OrderDetail::where('refund', true)->paginate(20);
        return view('admin.status.refund',['orders' => $orders]);
    }
}
