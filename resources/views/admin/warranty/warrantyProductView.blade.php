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
                    <h6 class="card-title">Danh sách bảo hành</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã hóa đơn</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ngày hết hạn bảo hành</th>
                                    <th style="width: 150px;"></th>  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warranties as $warranty)
                                    <tr>
                                        <th>{{ ($warranties->currentPage()-1) * $warranties->perPage() + $loop->index+1; }}</th>
                                        <th>{{ $warranty->order->id }}</th>
                                        <th>{{ $warranty->product->name }}</th>
                                        <th>{{ $warranty->expired }}</th>
                                        {{-- @can('edit product') --}}
                                            <th style="text-align:center;display: flex;"> 
                                                <a class="btn btn-success" href="{{ route('warranty.edit', [$warranty->id]) }}">Gia hạn</a>&nbsp;
                                                <form action="{{ route('warranty.destroy', [$warranty->id]) }}" method="POST">
                                                    <input type="hidden" name="_method" value="Delete">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-danger" class="btn btn-xs btn-danger" value="Xóa" onclick="return window.confirm('Bạn có thực sự muốn xóa');">
                                                </form>
                                            </th>
                                        {{-- @endcan --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example" style="margin-top: 30px">
                            <ul class="pagination">
                                {{ $warranties->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection