<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品修改</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>

	
<ul class="nav nav-pills">
    <li class="active"><a href="#">首页</a></li>
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('brand')}}">商品品牌<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a  href="{{url('brand/create')}}" >商品品牌添加</a></li>
        <li><a href="{{url('brand')}}">商品品牌展示</a></li>
      </ul>
	</li>
	<li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('category')}}">商品分类<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a  href="{{url('category/create')}}" >商品分类添加</a></li>
        <li><a href="{{url('category')}}">商品分类展示</a></li>
      </ul>
	</li>
	<li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('goods')}}">商品管理<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a  href="{{url('goods/goods')}}">商品添加</a></li>
        <li><a href="{{url('goods/index')}}">商品展示</a></li>
      </ul>
	</li>
	<li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('admin')}}">管理员管理<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a  href="{{url('admin/create')}}">管理员添加</a></li>
        <li><a href="{{url('admin')}}">管理员展示</a></li>
      </ul>
    </li>
</ul>
	<h2><b>商品<font color=red>修改</font></b></h2><hr>
	<!-- 表单提示错误信息 手册第321页-322页-->
		<!-- @if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif -->
<form class="form-horizontal sky" role="form" action="{{url('goods/update/'.$goods->goods_id)}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="goods_name"
			value="{{$goods->goods_name}}"
				   placeholder="请输入商品名称">
				    <b><font color=red>{{$errors->first("goods_name")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="goods_price"
			value="{{$goods->goods_price}}"
				   placeholder="请输入商品价格">
				   <b><font color=red>{{$errors->first("goods_price")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品介绍</label>
		<div class="col-sm-5">
				<textarea class="form-control" rows="3" name="goods_desc">{{$goods->goods_desc}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-5">

			<input type="text" class="form-control" id="firstname" name="goods_num"
			value="{{$goods->goods_num}}"
				   placeholder="请输入商品库存">
				   <b><font color=red>{{$errors->first("goods_num")}}</font></b>
		</div>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品积分</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="goods_score"
			value="{{$goods->goods_score}}"
				   placeholder="请输入分类积分">
				   <b><font color=red>{{$errors->first("goods_score")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-5">
			<input type="file"  id="firstname" name="goods_img"
				   placeholder="请输入分类名称">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">当前图片</label>
		<div class="col-sm-5">
			<img src="{{env('UPLOADS_URL')}}{{$goods->goods_img}}" width="80px">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-5">
			<input type="file"  id="firstname" name="goods_imgs"
				   placeholder="请输入分类名称">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-5">
			<input type="radio" name="is_new" @if($goods->is_new==1) checked="checked" @endif value="1">是
			<input type="radio" name="is_new" @if($goods->is_new==2) checked="checked" @endif value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否热销</label>
		<div class="col-sm-5">
			<input type="radio" name="is_hot" @if($goods->is_hot==1) checked="checked" @endif value="1">是
			<input type="radio" name="is_hot" @if($goods->is_hot==2) checked="checked" @endif value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-5">
			<input type="radio" name="is_best" @if($goods->is_best==1) checked="checked" @endif value="1">是
			<input type="radio" name="is_best" @if($goods->is_best==2) checked="checked" @endif value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否上架</label>
		<div class="col-sm-5">
			<input type="radio" name="is_up" @if($goods->is_up==1) checked="checked" @endif value="1">是
			<input type="radio" name="is_up" @if($goods->is_up==2) checked="checked" @endif value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-5">
			<select name="brand_id" id="">
				<option value="">请选择</option>
				@foreach($brand_id as $v)
				<option value="{{$v->brand_id}}" @if($goods->brand_id) selected="selected" @endif>{{$v->brand_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-5">
			<select name="cate_id" id="">
				<option value="">请选择</option>
				@foreach($category as $v)
				<option value="{{$v->cate_id}}" @if($goods->cate_id) selected="selected" @endif>{{str_repeat('——|',$v->level)}}{{$v->cate_name}}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-5">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>

</form>
</body>
</html>