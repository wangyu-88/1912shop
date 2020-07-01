<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品分类展示</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/jquery.min.js"></script>
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

<center>
	<h1>商品分类展示
		<a href="{{url('category/create')}}" style="float:right;">
			<button type="button" class="btn btn-success">添加</button>
		</a>
	</h1>
</center><hr/>



<table class="table table-bordered">
	<thead>
		<tr>
			<th>分类ID</th>
			<th>分类名称</th>
			<th>是否显示</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($category as $v)
		<tr>
			<td>{{$v->cate_id}}</td>
			<td>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</td>
			<td>{{$v->is_show==1?'是':'否'}}</td>
			<td>
				<a href="{{url('category/edit/'.$v->cate_id)}}"><button type="button" class="btn btn-primary">编辑</button></a>
				<a href="{{url('category/destroy/'.$v->cate_id)}}"><button type="button" class="btn btn-danger">删除</button></a>
			</td>
		</tr>
		@endforeach
		
	</tbody>
</table>

</body>
</html>