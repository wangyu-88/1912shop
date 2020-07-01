@extends('index.layouts.shop')
@section('title', '全部商品 最新')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select">
      <li class="pro-selCur"><a href="{{url('prolists')}}">新品</a></li>
      <li><a href="{{url('prolistss')}}">销量</a></li>
      <li><a href="{{url('proprice')}}">价格</a></li>
     </ul><!--pro-select/-->
     <div class="prolist">
      @foreach($is_new as $v)
      <dl>
       <dt><a href="{{url('proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('proinfo/'.$v->goods_id)}}">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>￥{{$v->goods_price-100}}</strong> <span>￥{{$v->goods_price}}</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>剩余：{{$v->goods_num}}</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
     </div><!--prolist/-->
     @endsection
