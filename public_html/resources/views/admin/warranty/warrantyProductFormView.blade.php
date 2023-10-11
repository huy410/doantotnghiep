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
			<h6 class="card-title">Gia hạn bảo hành</h6>
            <form class="forms-sample" method="post" action="{{ route('warranty.update', [$id]) }}" enctype="multipart/form-data" >
                <input type="hidden" name="_method" value="PATCH">	
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="exampleInputUsername1">Thời gian muốn gia hạn thêm (ngày)</label>
					<input type="number" name="expired" class="form-control" min="0">
				</div>
				<input type="submit" value="OK" class="btn btn-primary">
				<a class="btn btn-light" href="{{ route("warranty.index") }}">Cancel</a>
			</form>
		</div>
	</div>
</div>

@endsection