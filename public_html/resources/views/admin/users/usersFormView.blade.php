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
			<h6 class="card-title">Thêm/sửa admin</h6>
				@if (isset($record))
					<form class="forms-sample" method="post" action="{{ route('users.update', [$record->id]) }}" enctype="multipart/form-data" >
					<input type="hidden" name="_method" value="PATCH">	
				@else
					<form class="forms-sample" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data" >
				@endif
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="exampleInputUsername1">Tên tài khoản</label>
					<input type="text" value="<?php echo isset($record->name) ? $record->name : old('name') ; ?>" name="name" class="form-control">
				</div>
				<div class="form-group">
					<label for="exampleInputUsername1">Email</label>
					<input type="text" value="<?php echo isset($record->email) ? $record->email : old('email') ; ?>" name="email" class="form-control">
				</div>
				<div class="form-group">
					<label for="exampleInputUsername1">Password</label>
					<input type="text" value="<?php echo isset($record->password) ? $record->password : old('password') ; ?>" name="password" class="form-control">
				</div>
				@if (!isset($record))
					<div class="form-group">
						<label for="exampleInputUsername1">Password confirm</label>
						<input type="text" value="{{ old('password_confirmation'); }}" name="password_confirmation" class="form-control">
					</div>
				@endif
				<div class="form-group" style="display: flex;">
					<label style="margin-right: 50px; padding-top: 10px">Chức vụ</label>
					<select name="role" class="form-control" style="width:200px;">                 
						 @foreach ($roles as $role)
							<option 
								@if (isset($record)&&$record->hasRole($role->name)==$role->name)
									selected
								@endif
								value="<?php echo $role->name; ?>">
								<?php echo $role->name; ?>
							</option>
						 @endforeach
					</select>
				</div>
				<input type="submit" value="OK" class="btn btn-primary">
				<a class="btn btn-light" href="{{ route("users.index") }}">Cancel</a>
			</form>
		</div>
	</div>
</div>

@endsection