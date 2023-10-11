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
<style>
    .online_dot {
        height: 5px;
        width: 5px;
        background-color: green;
        border-radius: 50%;
        display: inline-block;
    }
</style>
<style>
    .offline_dot {
        height: 5px;
        width: 5px;
        background-color: grey;
        border-radius: 50%;
        display: inline-block;
    }
</style>
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
                    <form class="active-cyan-4 input-search" method="post" action="{{ route('users.search') }}">
                        @csrf
                        <input class="form-control" type="text" name="search" placeholder="Tìm kiếm email admin" aria-label="Search">
                        <button  class="btn btn-primary" type="submit">Search</button>
                    </form>
                     @can('edit user')
                    <div style=" float: right;">
                        <a href="{{ route('users.create') }}" class="btn btn-primary"><h6>Thêm mới admin</h6></a>
                    </div>
                    @endcan
                    <h6 class="card-title">Danh sách admin</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên tài khoản</th>
                                    <th>Email</th>
                                    <th>Chức vụ</th>
                                    <th>Trạng thái</th>
                                    {{-- <th>Xác nhận email vào lúc</th>
                                    <th>Được lập ra lúc</th>
                                    <th>Đã cập nhật thông tin lúc</th> --}}
                                    <th></th>
                                    <th style="width: 150px;"></th>  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th>{{ ($users->currentPage()-1) * $users->perPage() + $loop->index+1; }}</th>
                                        <th>{{ $user->name }}</th>
                                        <th>{{ $user->email }}</th>
                                        @if ($user->hasRole('editor'))
                                            <th>editor</th>
                                        @elseif ($user->hasRole('admin'))
                                            <th>admin</th>
                                        @else
                                            <th>super admin</th>
                                        @endif
                                        <th><a href="{{ route("users.show", [$user->id]) }}" style="text-decoration: underline;">Chi tiết admin</a></th>                                       
                                        @can('edit user')
                                            <th style="text-align:center;display: flex;"> 
                                                <a class="btn btn-success" href="{{ route('users.edit', [$user->id]) }}">Chỉnh sửa</a>&nbsp;
                                                <form action="{{ route('users.destroy', [$user->id]) }}" method="POST">
                                                    <input type="hidden" name="_method" value="Delete">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-danger" class="btn btn-xs btn-danger" value="Xóa" onclick="return window.confirm('Bạn có thực sự muốn xóa');">
                                                </form>
                                            </th>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example" style="margin-top: 30px">
                            <ul class="pagination">
                                {{ $users->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection