<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>学生编辑</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>学生编辑
		<a href="{{url('student')}}" style="float:right;">
			<button type="button" class="btn btn-success">列表</button>
		</a>
	</h1>
</center><hr/>
<form class="form-horizontal" action="{{url('student/update/'.$student->s_id)}}" method='post' role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='name' value="{{$student->name}}" id="firstname" 
				   placeholder="请输入学生名称">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生性别</label>
		<div class="col-sm-10">
			<input type="radio" name='sex' @if($student->sex==1) checked="checked" @endif value='1'>男
			<input type="radio" name='sex' @if($student->sex==2) checked="checked" @endif value='2'>女
			<input type="radio" name='sex' @if($student->sex==3) checked="checked" @endif value='3'>人妖
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生年龄</label>
		<div class="col-sm-10">
			<input type="number" class="form-control" name='age' value="{{$student->age}}" id="lastname" 
				   >
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生年级</label>
		<div class="col-sm-10">
			<select name="class" id="" class="form-control">
				<option value="">--请选择--</option>
				<option value="1" @if($student->class==1) selected="selected" @endif>1910</option>
				<option value="2" @if($student->class==2) selected="selected" @endif>1911</option>
				<option value="3" @if($student->class==3) selected="selected" @endif>1912</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生头像</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name='head' id="lastname" 
				   >
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>