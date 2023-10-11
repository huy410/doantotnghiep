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
                    <h6 class="card-title">Danh sách đánh giá</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên tài khoản</th>
                                    <th>Tiêu đề</th>
                                    <th>Số sao</th>
                                    <th>Sản phẩm</th>
                                    <th></th> 
                                </tr>
                            </thead>
                            <thead id="qwe123" style="background: grey;">
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <th>{{ $loop->index+1; }}</th>
                                        <th>{{ $review->customer->name }}</th>
                                        <th>{{ $review->title }}</th>
                                        <th>{{ $review->total_star }}</th>
                                        <th>{{ $review->product->name }}</th>
                                        <th><a href="{{ route("reviews.show", [$review->id]) }}" style="text-decoration: underline;">Chi tiết đánh giá</a></th>
                                    </tr>                                       
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example" style="margin-top: 30px">
                            <ul class="pagination">
                                {{ $reviews->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.Echo.channel('ReviewEvent')
        .listen('newReview', (e) => {
            var customerName = e.customerName;
            var total_star = e.total_star;
            var title = e.title;
            var productName = e.productName;
            var idNewReview = e.idNewReview;
            document.getElementById("qwe123").innerHTML =  document.getElementById("qwe123").innerHTML+"<tr ><td>New</td> <td>"+customerName+"</td> <td>"+ title +"</td> <td>"+total_star +"</td> <td>"+productName+ "</td> <td> <a href='"+ idNewReview +"'>Chi tiết đánh giá</a> </td> </tr>";
        })
    </script>
 @endsection