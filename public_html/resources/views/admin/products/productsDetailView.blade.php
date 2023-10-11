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
                    <h6 class="card-title">Chi tiết sản phẩm</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Tên: @php
                                    echo $product->name;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Giá: @php
                                    echo $product->price;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Giảm Giá: @php
                                    echo $product->discount;
                                @endphp%</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Hàng còn lại: @php
                                    echo $product->remaining;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label id="hot_check" >Hiển thị trang chủ:</label>
                            </div>
                            <input type="hidden" id="value_hot" value="<?php echo $product->hot; ?>">
                            <script>
                                var x = document.getElementById("value_hot").value;
                                if(x==1){
                                    document.getElementById("hot_check").innerHTML = "Hot: Yes";
                                }else{
                                    document.getElementById("hot_check").innerHTML = "Hot: No";
                                }
                            </script>
                            <div class="form-group">
                                <label for="exampleInputUsername1">description: @php
                                    echo $product->description;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Danh mục sản phẩm: @php
                                    echo $product->category->name;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Thời gian thêm sản phẩm: @php
                                    echo $product->created_at;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Thời gian sửa sản phẩm: @php
                                    echo $product->updated_at;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="images">Hình ảnh sản phẩm:</label>
                            </div>
                            <div class="form-group">
                                <div class="imgPreview" id="makeBlank">
                                    @php
                                        $images = explode('|', $product->image)
                                    @endphp
                                    @foreach ($images as $image)
                                        <img src="{{ asset('uploads/'.$image) }}">
                                    @endforeach
                                </div>
                            </div>  
                            <a class="btn btn-primary" href="{{ route("products.index") }}">Back</a>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection