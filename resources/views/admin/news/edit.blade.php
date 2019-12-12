@extends('layouts.layouts')
@section('title')
    News edit
@endsection
@section('content')
	{{--<script src="/ladmin/js/jquery-3.2.1.min.js"></script>--}}
	<script src="/ladmin/js/jquery.uploadify.js"></script>
	<link rel="stylesheet" href="/ladmin/css/uploadify.css">
    <form action="javascript:;">
	  <div class="form-group">
		<label for="exampleInputEmail1">News</label>
		<input type="text" class="form-control" id="exampleInputEmail1" name='n_name' value="{{ $news_info['n_name'] }}">
	  </div>
	  <div class="form-group">
		<label for="exampleInputPassword1">News described</label>
		<input type="text" class="form-control" id="exampleInputPassword1" name="n_desc" value="{{ $news_info['n_desc'] }}">
	  </div>
	  <div class="form-group">
		<label for="exampleInputFile">File input</label>
		<input type="file" id="uploadify">
		<p class="help-block">News photo.</p>
	  </div>
	  <div class="form-group" style="display: none">
			<label for="exampleInputFile">music input</label>
			<input type="file" id="uploadif">
			<p class="help-block">News photo.</p>
	  </div>
	  <div class="form-group">
		<label for="exampleInputPassword1">Content</label>
		 <textarea class="form-control" name="n_connect" rows="3">{{ $news_info['n_connect'] }}</textarea>
	  </div>
	  <div class="form-group">
		<label for="exampleInputPassword1">Classify</label>
			<select class="form-control" name='c_id'>
				@foreach($cart_info as $v)
					@if($news_info['c_id']==$v['c_id'])
			  			<option value="{{ $v['c_id'] }}" selected>{{ $v['c_name'] }}</option>
					@else
						<option value="{{ $v['c_id'] }}">{{ $v['c_name'] }}</option>
					@endif
				@endforeach
			</select>
	  </div>
		<input type="hidden" class="file" name="n_img" value="{{ $news_info['n_img'] }}">
		<input type="hidden" class="music" name="n_music" value="{{ $news_info['n_music'] }}">
		<input type="hidden" name="n_id" value="{{ $news_info['n_id'] }}">
	  <button type="submit" class="btn btn-default">Update</button>
	</form>
	<script>
		$(function () {
			$(document).on("click",".btn",function () {
				var data=$("form").serialize();
                $.ajax({
                    method:"POST",
                    url:"/admin/news/update",
                    data:data,
                    dataType: "json",
                    success:function (res) {
                        if (res.code!=1){
                            alert(res.error_message);
                        }else{
                            alert(res.error_message);
                            location.href="/admin/news/show";
                        }
                    }
                })
            })

			$(document).on("change",".form-control",function () {
			    if ($(this).val()=='5') {
                    $(".form-group").css("display", "block");
                }
            })

			$("#uploadify").uploadify({
				"swf":'/ladmin/swf/uploadify.swf',   //固定 引入swf文件
				'uploader':'/admin/news/save_file',     //后台地址
				"onUploadSuccess":function (file,data,msg) {
				    $(".file").val("/"+data);
				}
			});


            $("#uploadif").uploadify({
                "swf":'/ladmin/swf/uploadify.swf',   //固定 引入swf文件
                'uploader':'/admin/news/save_file',     //后台地址
                "onUploadSuccess":function (file,data,msg) {
                    $(".music").val("/"+data);
                }
            });
        })
	</script>
@endsection
