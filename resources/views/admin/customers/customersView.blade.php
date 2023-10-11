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
                    <form class="active-cyan-4 input-search" method="post" action="{{ route('customers.search') }}">
                        @csrf
                        <input class="form-control" type="text" name="search" placeholder="Tìm kiếm email khách hàng" aria-label="Search">
                        <button  class="btn btn-primary" type="submit">Search</button>
                    </form>
                    <h6 class="card-title">Danh sách người dùng</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên tài khoản</th>
                                    <th>Email</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <thead id="qwe123" style="background: grey;">
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <th>{{ ($customers->currentPage()-1) * $customers->perPage() + $loop->index+1; }}</th>
                                        <th>{{ $customer->name }}</th>
                                        <th>{{ $customer->email }}</th>
                                        <th><a href="{{ route("customers.show", [$customer->id]) }}" style="text-decoration: underline;">Chi tiết người dùng</a></th>   
                                        @can('edit product')
                                            <th style="text-align:center;display: flex;"> 
                                                <form action="{{ route('customers.destroy', [$customer->id]) }}" method="POST">
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
                                {{ $customers->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.Echo.private('NewCustomerEvent')
        .listen('newCustomer', (e) => {
            var name = e.tenTK;
            var email = e.email;
            var idNewCustomer = e.idNewCustomer;
            document.getElementById("qwe123").innerHTML =  document.getElementById("qwe123").innerHTML+"<tr ><td>New</td> <td>"+name+"</td> <td>"+email+ "</td> <td> <a href='"+ idNewCustomer +"'>Chi tiết đánh giá</a> </td> </tr>";
        })
    </script>
 @endsection