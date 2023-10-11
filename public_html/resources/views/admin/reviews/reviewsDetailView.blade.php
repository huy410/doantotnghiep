<!-- load file layout chung -->
@extends('admin.layout')
@section('content')
    <div class="col-md-12">
        <style type="text/css">
            .pagination{padding:0px; margin:0px; float: right;}
        </style>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Chi tiết đánh giá</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Tên tài khoản: @php
                                    echo $review->customer->name;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Tiêu đề: @php
                                    echo $review->title;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Số sao về giá: @php
                                    echo $review->price_review_star;
                                @endphp sao</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Số sao về chất lượng: @php
                                    echo $review->quality_review_star;
                                @endphp sao</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Số sao về giao hàng: @php
                                    echo $review->ship_review_star;
                                @endphp sao</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Sản phẩm: @php
                                    echo $review->product->name;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Chi tiết đánh giá: @php
                                    echo $review->review_detail;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Ngày đánh giá: @php
                                    echo $review->created_at;
                                @endphp</label>
                            </div>
                            <a class="btn btn-primary" href="{{ route("reviews.index") }}">Back</a>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection