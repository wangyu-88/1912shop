<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品展示</title>
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
	<h2><b>商品<font color=red>展示</font></b></h2><hr>
<form>
	<input type="text" name="goods_name" placeholder="请输入商品名称" value="{{$goods_name}}">
	<input type="submit" value="搜索">
</form>
<table class="table table-bordered">

	<thead>
		<tr>
			<th><input type="checkbox" class="all">全选</th>
			<th>商品编号</th>
			<th>商品名称</th>
			<th>商品价格</th>
			<th>商品介绍</th>
			<th>商品库存</th>
			<th>商品积分</th>
			<th>商品图片</th>
			<th>商品相册</th>
			<th>是否新品</th>
			<th>是否热销</th>
			<th>是否精品</th>
			<th>是否上架</th>
			<th>商品分类</th>
			<th>商品品牌</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($goods as $v)
		<tr>
			<td><input type="checkbox" name="check" goods_id = "{{$v->goods_id}}"></td>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_desc}}</td>
			<td>{{$v->goods_num}}</td>
			<td>{{$v->goods_score}}</td>
			<td>@if($v->goods_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="80px">@endif</td>
			<td>{{$v->goods_imgs}}</td>
			<td>@if($v->is_new==1)是@elseif($v->is_new==2)否@endif</td>
			<td>@if($v->is_hot==1)是@elseif($v->is_hot==2)否@endif</td>
			<td>@if($v->is_best==1)是@elseif($v->is_best==2)否@endif</td>
			<td>@if($v->is_up==1)是@elseif($v->is_up==2)否@endif</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->cate_name}}</td>
			<td>
				<a href="{{url('goods/destroy/'.$v->goods_id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
				<a href="{{url('goods/edit/'.$v->goods_id)}}">
					<button type="button" class="btn btn-success">修改</button>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<button type="button" class="btn btn-danger" id="desplay">删除选中商品</button>
<tr>
	<td colspan="6">{{$goods->appends(["goods_name"=>$goods_name])->links()}}</td>
</tr>

</body>
</html>
<script>
	//当点击设置好的class
	$('.all').click(function(){
		if (this.checked) { //this指当前对象
            $("[name=check]:checkbox").prop("checked", true); 
        }else{
            $("[name=check]:checkbox").prop("checked", false);
        }	
	})
	//批量删除
	$(document).on("click","#desplay",function(){
		var _this = $(this);
		var deletes = $(this);
		var _check = $("input[name='check']:checked");//获取选中的复选框
		if(_check.length==0){
			alert("请至少选中一条进行删除");return;
		}
		var goods_id = "";
		_check.each(function(index){
			goods_id += $(this).attr("goods_id")+",";
		})
		goods_id = goods_id.substr(0,goods_id.length-1);
			//ajax技术传给后台
			$.ajax({
				url:"checkdel",
				type:"get",
				data:{goods_id:goods_id},
				dataType:"json",
				success:function(res){
				}
			})

	})
</script>




