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
        </style>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div style=" float: right;">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary"><h6>Thêm mới danh mục sản phẩm</h6></a>
                    </div>
                    <h6 class="card-title">Danh mục sản phẩm</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Hiển thị trang chủ</th>
                                    <th>Thời điểm tạo ra</th>
                                    <th>Thời điểm cập nhật</th>
                                    {{-- <th>image</th> --}}
                                    {{-- <th>description</th>  
                                    <th>hotel type</th>
                                    <th>extra people</th>
                                    <th>minium stay</th> 
                                    <th>city</th>
                                    <th>country</th> --}}
                                    <th style="width: 150px;"></th>  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <th>{{ $loop->index+1; }}</th>
                                        <th>{{ $category->name }}</th>
                                        <th>
                                            @if ($category->display_home == 1)
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            @endif
                                        </th>
                                        <th>{{ $category->created_at }}</th>
                                        <th>{{ $category->updated_at }}</th>
                                        @can('edit category')
                                            <th style="text-align:center;display: flex;"> 
                                                <a class="btn btn-success" href="{{ route('categories.edit', [$category->id]) }}">Chỉnh sửa</a>&nbsp;
                                                <form action="{{ route('categories.destroy', [$category->id]) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-danger" class="btn btn-xs btn-danger" value="Xóa" onclick="return window.confirm('Bạn có thực sự muốn xóa');">
                                                </form>
                                            </th>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection