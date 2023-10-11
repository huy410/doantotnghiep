<!-- load file layout chung -->
@extends('admin.layout')
@section('content')
<div class="col-md-12">
    <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <h6 class="card-title">Danh sách trả hàng</h6>
        <div class="panel-body">
            <!-- thong tin don hang -->
            <table class="table table-bordered table-hover">
                 <tr>
                    <td style="text-align: center;">Tên sản phẩm</td>
                    <td style="text-align: center;">Giá sản phẩm</td>
                    <td style="text-align: center;">Số lượng sản phẩm</td>
                    <td style="text-align: center;">Ngày trả</td>
                    <td style="text-align: center;">Người trả</td>
                    <td style="text-align: center;">Tổng tiền</td>
                </tr>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $order->product->name; ?></td>
                        <td style="text-align: center;"><?php echo $order->product->price; ?></td>
                        <td style="text-align: center;"><?php echo $order->quantity; ?></td>
                        <td style="text-align: center;"><?php echo $order->updated_at; ?></td>
                        <td style="text-align: center;"><?php echo $order->order->customer->email; ?></td>
                        <td style="text-align: center;"><?php echo $order->price; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>            
        </div>
    </div>
    </div>
</div>
</div>
@endsection