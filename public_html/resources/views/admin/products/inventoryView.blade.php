<!-- load file layout chung -->
@extends('admin.layout')
@section('content')
@if ($errors->any())
	<div class="alert alert-danger alert-dismissible" role="alert">
		<ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

	</div>
@endif


    <div class="col-md-12">
        <style type="text/css">
            .pagination{padding:0px; margin:0px; float: right;}
            .input-search{
                width: 400px;
                border: 1px solid rgb(255, 255, 255);
                margin-bottom: 20px;
                display: flex;
            }
        </style>
       
        <div class="col-md-12 grid-margin stretch-card">
            
            <div class="card">
                <div class="card-body">
                    <form class="active-cyan-4 input-search" method="post" action="{{ route('products.search') }}">
                        @csrf
                        <input class="form-control" type="text" name="search" placeholder="Tìm kiếm tên sản phẩm" aria-label="Search">
                        <button  class="btn btn-primary" type="submit">Search</button>
                    </form>
                    <h6 class="card-title">Danh sách sản phẩm</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Hot</th>
                                    <th>Giá</th>
                                    <th>Hàng tồn kho</th>
                                    <th>Danh mục sản phẩm</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <th>{{ ($products->currentPage()-1) * $products->perPage() + $loop->index+1; }}</th>
                                        <th>{{ $product->name }}</th>
                                        <th>
                                            @if ($product->display_home == 1)
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            @endif
                                        </th>
                                        <th>{{ $product->price }}</th>
                                        <th>{{ $product->remaining }}</th>
                                        <th>{{ $product->category->name; }}</th>
                                        <th><a href="{{ route("products.show", [$product->id]) }}" style="text-decoration: underline;">Chi tiết sản phẩm</a></th>                                       
                                        <th style="text-align:center;display: flex;"> 
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example" style="margin-top: 30px">
                            <ul class="pagination">
                                {{ $products->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection