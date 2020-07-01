<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>添加文章</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<center>
	<h1>添加文章
		<a href="{{url('articel')}}" style="float:right;">
			<button type="button" class="btn btn-success">列表</button>
		</a>
	</h1>
</center><hr/>
<form class="form-horizontal" action="{{url('articel/store')}}" method='post' role="form" enctype="multipart/form-data">

	<!-- @if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif -->


	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='title' id="firstname" 
				   placeholder="请输入文章标题">
			<b style='color:red'>{{$errors->first('title')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-10">
			<select name="c_id" id="">
				<option value="">--请选择--</option>
				@foreach($cate as $v)
				<option value="{{$v->c_id}}">{{$v->c_name}}</option>
				@endforeach
			</select>
			<b style='color:red'>{{$errors->first('c_id')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-10">
			<input type="radio" name='importance' value='1'>普通
			<input type="radio" name='importance' value='2'>置顶
			<b style='color:red'>{{$errors->first('importance')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name='is_show' value='1'>显示
			<input type="radio" name='is_show' value='2'>不显示
			<b style='color:red'>{{$errors->first('is_show')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='writer' id="firstname" 
				   placeholder="请输入文章作者">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='email' id="firstname" 
				   placeholder="请输入作者email">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='keywords' id="firstname" 
				   placeholder="请输入关键字">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name='desc' id="lastname" 
				   placeholder="请输入网页描述"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name='img' id="lastname" 
				   >
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>