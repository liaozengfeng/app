@extends('layouts.layouts')
@section('title')
    商品
@endsection
@section('content')
	<form id="form">
	<input type="hidden" name="goods_id" value="{{ $res->goods_id }}">
	  <div class="form-group">
	    <label for="exampleInputEmail1">商品名称:</label>
	    <input type="text" class="form-control" name="goods_name" id="goods_name" placeholder="请填写名称" value="{{ $res->goods_name }}">
	  </div>

	  <div class="form-group">
	    <label for="exampleInputEmail1">商品品牌:</label>
	   	<select name="brand_id" class="form-control">
			<option value="{{ $res->brand_id }}">{{ $res->brand_name }}</option>
	   	</select>
	  </div>

	  <div class="form-group">
	    <label for="exampleInputEmail1">商品分类:</label>
	   	<select name="sort_id" class="form-control">
			<option value="{{ $res->sort_id }}">{{str_repeat('==',$res->level).$res->sort_name }}</option>
	   	</select>
	  </div>

	  <div class="form-group">
	    <label for="exampleInputEmail1">商品库存:</label>
	    <input type="text" class="form-control" name="goods_stock" id="goods_stock" placeholder="请填写库存" value="{{ $res->goods_stock }}">
	  </div>



	  <div class="form-group">
	    <label for="exampleInputEmail1">商品图片:</label>
	    <input type="file" name="goods_img">
	  </div>

	<div class="form-group">
	    <label for="content">商品描述</label>
	    <script id="goods_desc" name="goods_desc" type="text/plain">
		 {{ $res->goods_desc }}
		</script>
  </div> 

	  <div class="form-group">
	    <label for="exampleInputEmail1">商品价格:</label>
	      <input type="text" class="form-control" name="goods_pirce" id="goods_pirce" placeholder="请填写价格" value="{{ $res->goods_pirce }}">
	  </div>


	<div class="input-radio">

		<label for="exampleInputEmail1" >是否上架:</label>
	  <input class="is_show" type="radio" {{$res['is_is_up']==1?"checked":''}} name="is_up" value="1" checked />
	  <label for="city1">是</label>
	   <input class="is_show" type="radio" {{$res['is_up']==2?"checked":''}} name="is_up" value="0" />
	   <label for="city1">否</label> 	||

 		<label for="exampleInputEmail1" >是否热销:</label>
	  <input class="is_sale" type="radio" {{$res['is_sale']==1?"checked":''}} name="is_sale" value="1" checked />
	  <label for="city1">是</label>
	   <input class="is_sale" type="radio" {{$res['is_sale']==2?"checked":''}} name="is_sale" value="0" />
	   <label for="city1">否</label> 	||

	   	<label for="exampleInputEmail1" >是否是新品:</label>
	  <input class="is_new" type="radio" {{$res['is_new']==1?"checked":''}} name="is_new" value="1" checked />
	  <label for="city1">是</label>
	   <input class="is_new" type="radio" {{$res['is_new']==2?"checked":''}} name="is_new" value="0" />
	   <label for="city1">否</label>  	
	</div>


	  <button type="button" class="btn btn-default" id="tj">添加</button>
		<script src="{{ asset('js/ueditor/ueditor.config.js') }}"></script>
	    <!-- 编辑器源码文件 -->
	    <script type="text/javascript" src="{{ asset('js/ueditor/ueditor.all.min.js') }}"></script>
	    <!-- 实例化编辑器 -->
	    <script type="text/javascript">
	        var ue = UE.getEditor('goods_desc');
	        	//对编辑器的操作最好在编辑器ready之后再做
	        	var content="{!! $res->goods_desc ?? '' !!}";
				ue.ready(function() {
				    //设置编辑器的内容
				    ue.setContent(content);
				});

	    </script>

	</form>

	

	<script>

		$("#tj").click(function(){
			var form=new FormData($('#form')[0]);
			var goods_name=$('#goods_name').val();
			var goods_stock=$('#goods_stock').val();
			var goods_pirce=$('#goods_pirce').val();
		if (goods_name=='') {
			alert('商品名称不能为空');
			return false;
		}

		if (goods_stock=='') {
			alert('商品库存不能为空');
			return false;
		}

		if (goods_pirce=='') {
			alert('商品价格不能为空');
			return false;
		}

	$.ajax({
        url:"/admin/goods/GoodsUpdate_do",
        type:'post',
        data:form,
        processData: false, 
     	contentType: false,
     	dataType:'json',
     	success:function(res){
     		
     		if (res.code==1) {
	     			alert(res.font);
	     			location.href="/admin/goods/GoodsList";
	     		}else{
	     			alert(res.font);
	     		}
     		
     		}

		},'json')

	})

	</script>

@endsection