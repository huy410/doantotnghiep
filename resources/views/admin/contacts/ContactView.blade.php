<!-- load file layout chung -->
@extends('admin.layout')
@section('content')
    <div class="col-md-12">
        <style type="text/css">
            .pagination{padding:0px; margin:0px; float: right;}
        </style>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Chi tiết sản phẩm</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Số điện thoại: @php
                                    echo $contact->phone;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Link facebook: @php
                                    echo $contact->facebook_link;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Link instagram: @php
                                    echo $contact->instargram;
                                @endphp</label>
                            </div>
                            <div class="form-group">
                                <label for="images">Logo:</label>
                            </div>
                            <div class="form-group">
                                <div class="imgPreview" id="makeBlank">
                                        <img src="{{ asset('uploads/'.$contact->image) }}">
                                </div>
                            </div>  
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection