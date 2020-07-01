<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>品牌展示</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

<center>
	<h1>品牌展示
		<a href="{{url('brand/create')}}" style="float:right;">
			<button type="button" class="btn btn-success">添加</button>
		</a>
	</h1>
</center><hr/>

<form>
	<input type="text" name='brand_name' value="{{$brand_name}}" placeholder="请输入品牌名称关键字">
	<button>搜索</button>
</form>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>品牌ID</th>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌logo</th>
			<th>品牌描述</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($brand as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td>
				@if($v->brand_logo)
					<img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" width='50px' height='50px'>
				@endif
			</td>
			<td>{{$v->brand_desc}}</td>
			<td>
				<a href="{{url('brand/edit/'.$v->brand_id)}}"><button type="button" class="btn btn-primary">编辑</button></a>
				<button type="button" id="{{$v->brand_id}}" class="btn btn-danger">删除</button>
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="6">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td>
		</tr>
	</tbody>
</table>

<script>
	$(function(){
	    $(document).on('click','.btn-danger',function(){
	        // alert(22);die;
	        var id=$(this).attr('id');
	        var obj=$(this);
	        // alert(id);
	        if(confirm('确定删除吗！！')){
	            $.get('/brand/destroy/'+id,function(res){
	                if(res.code=='0'){
	                    location.href="/brand";
	                }
	            },'json')
	        }
	    })
	})	
</script>

</body>
</html>