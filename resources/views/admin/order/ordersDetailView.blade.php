<!-- load file layout chung -->
@extends('admin.layout')
@section('content')
    <div class="col-md-12">
        <div style="margin-bottom:5px;">
            <input onclick="history.go(-1);" type="button" value="Back" class="btn btn-danger">
        </div>    
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Chi tiết hóa đơn</h6>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th style="width: 100px;">Họ tên</th>
                                <td><?php echo $order->customer->name; ?></td> 
                            </tr>
                            <tr>
                                <th style="width: 100px;">Email</th>
                                <td><?php echo $order->customer->email; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 100px;">Tổng tiền</th>
                                <td><?php echo number_format($order->total_price); ?>đ</td>
                            </tr>
                            <tr>
                                <th style="width: 100px;">Ngày đặt</th>
                                <td><?php echo $order->created_at; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 100px;">Địa điểm nhận hàng</th>
                                <td><?php echo $order->position; ?></td>
                            </tr>
                        </table>
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td style="text-align: center;">Tên sản phẩm</td>
                                <td style="text-align: center;">Giá sản phẩm</td>
                                <td style="text-align: center;">Số lượng sản phẩm</td>
                                <td style="text-align: center;">Tổng tiền</td>
                            </tr>
                            <?php foreach($orderDetail as $rows): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $rows->product->name; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($rows->product->price); ?> VND</td>
                                    <td style="text-align: center;"><?php echo $rows->quantity; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($rows->price); ?> VND</td>
                                </tr>
                            <?php endforeach; ?>
                        </table>            
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection