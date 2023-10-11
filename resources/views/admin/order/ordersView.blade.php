<!-- load file layout chung -->
@extends('admin.layout')
@section('content')
<div class="col-md-12">
    <style type="text/css">
        .pagination{padding:0px; margin:0px; float: right; margin-top: 5px;}
    </style>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Danh sách Orders</h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tên khách hàng</th>
                                <th>Ngày mua hàng</th> 
                                <th>Phương thức thanh toán</th>
                                <th>Tổng tiền</th>
                                <th>Tình trạng hàng</th>  
                                <th>Chi tiết đơn hàng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <thead id="qwe123" style="background: grey;">
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order): ?>
                                <tr>
                                    <td><?php echo $order->customer->name; ?></td> 
                                    <td><?php echo $order->created_at; ?></td>
                                    <td><?php echo $order->payment_method; ?></td>
                                    <td><?php echo number_format($order->total_price); ?></td>
                                    <td>
                                        <?php echo $order->payment_status ? 'đã thanh toán' : 'chưa thanh toán'; ?> /
                                        <?php echo $order->ship_status ? 'đã giao hàng' : 'chưa giao hàng'; ?>
                                    </td>
                                    <td><a href="{{ route('orders.show', $order->id) }}">Chi tiết đơn hàng</a></td>
                                        <td>
                                            @if ($order->payment_status == false && $order->ship_status == false)
                                                <a href="{{ route('orders.delivery', ['id'=> $order->id]) }}" class="btn btn-danger">Giao hàng</a>
                                                <a href="{{ route('orders.payment', ['id'=> $order->id]) }}" class="btn btn-primary">Thanh toán</a>
                                            @elseif($order->payment_status == false)
                                                <a href="{{ route('orders.payment', ['id'=> $order->id]) }}" class="btn btn-primary">Thanh toán</a>
                                            @elseif($order->ship_status == false)
                                                <a href="{{ route('orders.delivery', ['id'=> $order->id]) }}" class="btn btn-danger">Giao hàng</a>
                                            @endif
                                        </td>
                                        {{-- script alert realtime --}}
                                        <script>
                                            window.Echo.channel('OrderEvent')
                                            .listen('newOrder', (e) => {
                                                var customerNewOrder = e.customerNewOrder;
                                                var dateNewOrder = e.dateNewOrder;
                                                var priceNewOrder = e.priceNewOrder;
                                                var idNewOrder = e.idNewOrder;
                                                var paymentMethod = e.paymentMethod;
                                                var paymentStatus = e.paymentStatus;
                                                var shipStatus = e.shipStatus;
                                                var buttonPayment = e.buttonPayment;
                                                var buttonDelivery = e.buttonDelivery;
                                    
                                               if (e.paymentStatus == false) {
                                                    document.getElementById("qwe123").innerHTML =  document.getElementById("qwe123").innerHTML+"<tr> <td>"+customerNewOrder+
                                                    "</td> <td>"+ e.dateNewOrder +"</td> <td>"+e.paymentMethod+"</td> <td>"+priceNewOrder+
                                                    "</td> <td>chưa thanh toán/chưa giao hàng</td> <td> <a href='"+ idNewOrder +"'>Chi tiết đơn hàng</a> </td> <td> <a href='"
                                                    + buttonDelivery + "'class='btn btn-danger'>Giao hàng </a> <a href='"+ buttonPayment + "'class='btn btn-primary'>Thanh toán </a>  </td> </tr>";
                                                } else {
                                                    document.getElementById("qwe123").innerHTML =  document.getElementById("qwe123").innerHTML+"<tr> <td>"+customerNewOrder+
                                                    "</td> <td>"+ e.dateNewOrder +"</td> <td>"+e.paymentMethod+"</td> <td>"+priceNewOrder+
                                                    "</td> <td>đã thanh toán/chưa giao hàng</td> <td> <a href='"+ idNewOrder +"'>Chi tiết đơn hàng</a> </td> <td> <a href='"
                                                    + buttonDelivery + "'class='btn btn-danger'>Giao hàng </a> </td> </tr>";
                                                }
                                            })
                                        </script>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        
                    </table>
                    <nav aria-label="Page navigation example" style="margin-top: 30px">
                        <ul class="pagination">
                            {{ $orders->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
    
 @endsection