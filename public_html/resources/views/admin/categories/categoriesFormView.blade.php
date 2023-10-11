
@extends('admin.layout')
@section('content')
@if ($errors->any())
	<div class="alert alert-danger alert-dismissible" role="alert">
		<ul style="list-style: none">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
@endif
<div class="col-md-12">
		@if ( Session::has('error') )  
			<div class="alert alert-warning">{{ Session::get('error') }}</div>
		@endif	
		<div class="card">
		<div class="card-body">
			<h6 class="card-title">Thêm/Sửa danh mục sản phẩm</h6>
				@if (isset($record))
					<form class="forms-sample" method="post" action="{{ route('categories.update', [$record->id]) }}" enctype="multipart/form-data" >
					<input type="hidden" name="_method" value="PATCH">	
				@else
					<form class="forms-sample" method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
				@endif
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="exampleInputUsername1">Tên</label>
					<input type="text" value="<?php echo isset($record->name) ? $record->name : old('name') ; ?>" name="name" class="form-control" required>
				</div>
                <div class="form-group">
					<label for="exampleInputUsername1">Hiển thị trang chủ</label>
					<input type="checkbox" style="margin-left: 10px;margin-top:0px; width: 20px; height: 20px;" id="check_hot" onclick="check()">
                    <input type="hiden" id="value_hot" name="display_home" value="<?php echo  isset($record->display_home) ? $record->display_home : 0 ; ?>" style="display: none">
                    <script type="text/javascript">
					 	var x = document.getElementById("value_hot").value;
						if(x==1){
							document.getElementById("check_hot").checked = true;
						}
                        function check(){
                          var g = document.getElementById("check_hot").checked;
                            if(g == true){
                           	document.getElementById("value_hot").value = "1";
                          }
                            else{
                              document.getElementById("value_hot").value = "0";
                          }
                        }
                     </script>
				</div>
				<input type="submit" value="OK" class="btn btn-primary">
				<a class="btn btn-light" href="{{ route("categories.index") }}">Cancel</a>
			</form>
		</div>
	</div>
</div>

@endsection