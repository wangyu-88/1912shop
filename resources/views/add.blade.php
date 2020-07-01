<form action="{{url('adddo')}}" method='get'>
	@csrf
	<input type="text" name='test'>
	<button>add</button>
</form>