<h2>添加学生</h2><hr/>
{{$name}}
<form action="{{url('create')}}" method='post'>
	@csrf
	<input type="text" name='test'>
	<button>添加</button>
</form>