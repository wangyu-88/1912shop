@extends('index.layouts.shop')
@section('title', '我的')
@section('content')
  <body>
    <div class="maincont">
     <div class="userName">
      <dl class="names">
       <dt><img src="/static/index/images/touxiang.jpg" /></dt>
       <dd>
        <h3>{{$admin->name}}</h3>
       </dd>
       <div class="clearfix"></div>
      </dl>
      <div class="shouyi">
       <dl>
        <dt>我的余额</dt>
        <dd>0.00元</dd>
       </dl>
       <dl>
        <dt>我的积分</dt>
        <dd>0</dd>
       </dl>
       <div class="clearfix"></div>
      </div><!--shouyi/-->
     </div><!--userName/-->
     
     <ul class="userNav">
      <li><span class="glyphicon glyphicon-list-alt"></span><a href="{{url('order')}}">我的订单</a></li>
      <div class="height2"></div>
      <div class="state">
         <dl>
          <dt><a href="{{url('order')}}"><img src="/static/index/images/user1.png" /></a></dt>
          <dd><a href="{{url('order')}}">待支付</a></dd>
         </dl>
         <dl>
          <dt><a href="{{url('order')}}"><img src="/static/index/images/user2.png" /></a></dt>
          <dd><a href="{{url('order')}}">代发货</a></dd>
         </dl>
         <dl>
          <dt><a href="{{url('order')}}"><img src="/static/index/images/user3.png" /></a></dt>
          <dd><a href="{{url('order')}}">待收货</a></dd>
         </dl>
         <dl>
          <dt><a href="{{url('order')}}"><img src="/static/index/images/user4.png" /></a></dt>
          <dd><a href="{{url('order')}}">全部订单</a></dd>
         </dl>
         <div class="clearfix"></div>
      </div><!--state/-->
      <li><span class="glyphicon glyphicon-usd"></span><a href="{{url('quan')}}">我的优惠券</a></li>
      <li><span class="glyphicon glyphicon-map-marker"></span><a href="{{url('addaddress')}}">收货地址管理</a></li>
      <li><span class="glyphicon glyphicon-star-empty"></span><a href="{{url('shoucang')}}">我的收藏</a></li>
      <li><span class="glyphicon glyphicon-heart"></span><a href="{{url('shoucang')}}">我的浏览记录</a></li>
      <li><span class="glyphicon glyphicon-usd"></span><a href="{{url('tixian')}}">余额提现</a></li>
	 </ul><!--userNav/-->
     
     <div class="lrSub">
       <a href="{{url('quit')}}">退出登录</a>
     </div>
        @endsection