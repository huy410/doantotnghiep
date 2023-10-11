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
<style>
	.imgPreview img {
		padding: 8px;
		max-width: 100px;
	}
	.imgPreview2 img{
		padding: 8px;
		max-width: 100px;
	} 
</style>
<div class="col-md-12">
		@if ( Session::has('error') )  
			<div class="alert alert-warning">{{ Session::get('error') }}</div>
		@endif	
		<div class="card">
		<div class="card-body">
			<h6 class="card-title">Thêm/sửa sản phẩm</h6>
				@if (isset($record))
					<form class="forms-sample" method="post" action="{{ route('products.update', [$record->id]) }}" enctype="multipart/form-data" >
					<input type="hidden" name="_method" value="PATCH">	
				@else
					<form class="forms-sample" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" >
				@endif
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="exampleInputUsername1">Tên</label>
					<input type="text" value="<?php echo isset($record->name) ? $record->name : old('name') ; ?>" name="name" class="form-control">
				</div>
				<div class="form-group">
					<label for="exampleInputUsername1">Giá</label>
					<input type="text" value="<?php echo isset($record->price) ? $record->price : old('price') ; ?>" name="price" class="form-control">
				</div>
				<div class="form-group">
					<label for="exampleInputUsername1">Mô tả sản phẩm</label>
					<textarea name="description"><?php echo isset($record->description) ? $record->description: old('description'); ?></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace("description");
                    </script>
				</div>
				<div class="form-group">
					<label for="exampleInputUsername1">Giảm giá (%)</label>
					<input type="text" value="<?php echo isset($record->discount) ? $record->discount : old('discount') ; ?>" name="discount" class="form-control">
				</div>
				<div class="form-group">
					<label for="exampleInputUsername1">Hàng còn lại</label>
					<input type="text" value="<?php echo isset($record->remaining) ? $record->remaining : old('remaining') ; ?>" name="remaining" class="form-control">
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
                        	if (g == true) {
                           		document.getElementById("value_hot").value = "1";
							}
							else {
								document.getElementById("value_hot").value = "0";
							}
                        }
                     </script>
				</div>
				<div class="form-group" style="display: flex;">
					<label style="margin-right: 50px; padding-top: 10px">Nhóm sản phẩm</label>
					<select name="category_id" class="form-control" style="width:200px;">                 
						 @foreach ($categories as $category)
							<option 
								@if (isset($record->category_id)&&$record->category_id==$category->id)
									selected
								@endif
								value="<?php echo $category->id; ?>">
								<?php echo $category->name; ?>
							</option>
						 @endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="images">Hình ảnh sản phẩm</label>
					<input type="file" id="images" name="imageFile[]" class="form-control" multiple="multiple">
				</div>
				<div class="mb-3">
					<div class="imgPreview" id="makeBlank">
						@if	(isset($record->image))
							@php
								$images = explode('|', $record->image)
							@endphp
							@foreach ($images as $image)
								<img src="{{ asset('uploads/'.$image) }}">
							@endforeach
						@endif
					</div>
				</div>  
				<script>
					$(function() {
						// Multiple images preview with JavaScript
						function multiImgPreview(input, imgPreviewPlaceholder) {
				
							if (input.files) {
								var filesAmount = input.files.length;
				
								for (i = 0; i < filesAmount; i++) {
									var reader = new FileReader();
									document.getElementById("makeBlank").textContent  = "";
									reader.onload = function(event) {
										$($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
									}
				
									reader.readAsDataURL(input.files[i]);
								}
							}
							
				
						};
				
						$('#images').on('change', function() {
							multiImgPreview(this, 'div.imgPreview');
						});
					});    
				</script>
               
				<input type="submit" value="OK" class="btn btn-primary">
				<a class="btn btn-light" href="{{ route("categories.index") }}">Cancel</a>
			</form>
		</div>
	</div>
</div>

@endsection