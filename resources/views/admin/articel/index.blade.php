<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>文章展示</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<center>
	<h1>文章展示
		<a href="{{url('articel/create')}}" style="float:right;">
			<button type="button" class="btn btn-success">添加</button>
		</a>
	</h1>
</center><hr/>

<form>
	<input type="text" name='title' value="{{$title}}" placeholder="请输入文章标题关键字">
	<select name="c_name" id="">
				<option value="">--请选择--</option>
				@foreach($cate as $v)
				<option value="{{$v->c_name}}">{{$v->c_name}}</option>
				@endforeach
	</select>
	<button>搜索</button>
</form>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>ID</th>
			<th>文章标题</th>
			<th>文章分类</th>
			<th>文章重要性</th>
			<th>是否显示</th>
			<th>上传文件</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($articel as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->title}}</td>
			<td>{{$v->c_name}}</td>
			<td>{{$v->importance==1?'普通':'置顶'}}</td>
			<td>{{$v->is_show==1?'是':'否'}}</td>
			<td>
				@if($v->img)
					<img src="{{env('UPLOADS_URL')}}{{$v->img}}" width='50px' height='50px'>
				@endif
			</td>
			<td>
				<a href="{{url('articel/edit/'.$v->id)}}"><button type="button" class="btn btn-primary">编辑</button></a>
				<button type="button" id="{{$v->id}}" class="btn btn-danger">删除</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{{$articel->appends(['title'=>$title,'c_name'=>$c_name])->links()}}

<script>
	$(function(){
	    $(document).on('click','.btn-danger',function(){
	        // alert(22);die;
	        var id=$(this).attr('id');
	        var obj=$(this);
	        // alert(obj);die;
	        if(confirm('确定删除吗！！')){
	            $.get('/articel/destroy/'+id,function(res){
	                if(res.code=='0'){
	                    location.href="/articel";
	                }
	            },'json')
	        }
	    })
	})	
</script>
</body>
</html>