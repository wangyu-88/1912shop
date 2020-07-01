<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品添加</title>
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
	<h2><b>商品<font color=red>添加</font></b></h2><hr>
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
<form class="form-horizontal sky" role="form" action="{{url('goods/store')}}" method="post" enctype="multipart/form-data">
	@csrf

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="goods_name"
				   placeholder="请输入商品名称">
				   <b><font color=red>{{$errors->first("goods_name")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="goods_price"
				   placeholder="请输入商品价格">
				   <b><font color=red>{{$errors->first("goods_price")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品介绍</label>
		<div class="col-sm-5">
				<textarea class="form-control" rows="3" name="goods_desc"></textarea>
				<b><font color=red>{{$errors->first("goods_desc")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-5">

			<input type="text" class="form-control" id="firstname" name="goods_num"
				   placeholder="请输入商品库存">
				   <b><font color=red>{{$errors->first("goods_num")}}</font></b>
		</div>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品积分</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="goods_score"
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
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-5">
			<input type="file"  id="firstname" name="goods_imgs"
				   placeholder="请输入分类名称">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-5">
			<input type="radio" name="is_new" value="1" checked>是
			<input type="radio" name="is_new" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否热销</label>
		<div class="col-sm-5">
			<input type="radio" name="is_hot" value="1" checked>是
			<input type="radio" name="is_hot" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-5">
			<input type="radio" name="is_best" value="1" checked>是
			<input type="radio" name="is_best" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否上架</label>
		<div class="col-sm-5">
			<input type="radio" name="is_up" value="1" checked>是
			<input type="radio" name="is_up" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-5">
			<select name="brand_id" id="">
				<option value="">请选择</option>
				@foreach($brand_id as $v)
				<option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
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
				<option value="{{$v->cate_id}}">{{str_repeat('——|',$v->level)}}{{$v->cate_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-5">
			<button type="button" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
	$(function(){
		//商品名称
		$(document).on("blur","input[name='goods_name']",function(){
			var _this = $(this);
			var goods_name = _this.val();
			_this.next().empty();
			var reg = /^[\u4e00-\u9fa5\w]{2,15}$/;
			if(!reg.test(goods_name)){
				_this.next().text("商品名称需由中文、字母、数字、下划线长度2-15位组成");
			}
			//唯一性验证
			$.ajax({
				url:"checkname",
				type:"get",
				data:{goods_name:goods_name},
				async:true,
				dataType:"json",
				success:function(res){
					if(res.count){
						_this.next().text("商品名称已存在");
					}
				}
			})
		})
		//商品价格
		$(document).on("blur","input[name='goods_price']",function(){
			var _this = $(this);
			var goods_price = _this.val();
			_this.next().empty();
			var reg = /^\d{1,10}$/;
			if(!reg.test(goods_price)){
				_this.next().text("商品价格纯数字,长度1-10位组成");
			}
		})
		//商品库存
		$(document).on("blur","input[name='goods_num']",function(){
			var _this = $(this);
			var goods_num = _this.val();
			_this.next().empty();
			var reg = /^\d{1,5}$/;
			if(!reg.test(goods_num)){
				_this.next().text("商品库存纯数字,长度1-5位组成");
			}
		})
		//提交按钮
		$(document).on("click","button[type='button']",function(){
			var _this = $("input[name='goods_name']");
			var goods_name = _this.val();
			_this.next().empty();
			var reg = /^[\u4e00-\u9fa5\w]{2,15}$/;
			if(!reg.test(goods_name)){
				_this.next().text("商品名称需由中文、字母、数字、下划线长度2-15位组成");
			}

			//唯一性验证
			$.ajax({
				url:"checkname",
				type:"get",
				data:{goods_name:goods_name},
				async:false,
				dataType:"json",
				success:function(res){
					if(res.count){
						_this.next().text("商品名称已存在");
					}
				}
			})
			//商品价格
			var _this = $("input[name='goods_price']");
			var goods_price = _this.val();
			_this.next().empty();
			var reg = /^\d{1,10}$/;
			if(!reg.test(goods_price)){
				_this.next().text("商品价格纯数字,长度1-10位组成");
			}
			//商品积分
			var _this = $("input[name='goods_num']");
			var goods_num = _this.val();
			_this.next().empty();
			var reg = /^\d{1,5}$/;
			if(!reg.test(goods_num)){
				_this.next().text("商品库存纯数字,长度1-5位组成");return;
			}
			$("form").submit();

		})
	})
</script>