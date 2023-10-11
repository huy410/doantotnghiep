@extends('admin.layout')
@section('content')
<form method="post" action="" style="margin-left: 30px; margin-bottom: 10px">
    @csrf
    <input type="date" name="date1" value="<?php echo date('Y-m-d') ?>"/>
    <input type="date" name="date2" value="<?php echo date('Y-m-d') ?>"/>
    <input type="submit" value="tra cứu thông kê" class="btn btn-primary" />
</form>
<div class="col-md-12">
    <div class="col-md-12 grid-margin stretch-card">
        
        <div class="card">
            <div class="card-body">
            <h6 class="card-title">Báo cáo thống kê</h6>
            <div class="panel-body">
                <!-- thong tin don hang -->
                <table class="table table-bordered table-hover">
                    <tr>
                        <td style="text-align: center;">Ngày</td>
                        <td style="text-align: center;">Số lượng đơn hàng</td>
                        <td style="text-align: center;">Tổng số khách</td>
                        <td style="text-align: center;">Tổng tiền thu được</td>
                    </tr>
                    <?php if(isset($getThongKes)): ?>
                        <?php foreach($getThongKes as $getThongKe): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $getThongKe->created_at ?></td>
                                <td style="text-align: center;"><?php echo $getThongKe->total_order ?></td>
                                <td style="text-align: center;"><?php echo $getThongKe->total_customer ?></td>
                                <td style="text-align: center;"><?php echo $getThongKe->total_money ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>            
            </div>
        </div>
        </div>
    </div>
</div>
@endsection