@extends('index.layouts.shop')
@section('title', '首页')
@section('content')
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
      <dl>
       <dt><a href="{{url('user')}}"><img src="/static/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">{{$res['admin_account']}}</h1>
        <ul>
         <li><a href="{{url('prolists')}}"><strong>{{$count}}</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
      @if($res['admin_account']=="")
     <ul class="reg-login-click">
      <li><a href="{{url('/login')}}">登录</a></li>
      <li><a href="{{url('/reg')}}" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
      @else
       <ul class="reg-login-click">
      <li><a><b class="rlbg"><font color=black>欢迎登录微商城</font></b></a></li>
      <li><a href="javascript:;" onclick="history.go(0)">立即刷新</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
      @endif
     <div id="sliderA" class="slider">
      @foreach($Goods as $v)
      <img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}">
      @endforeach

     </div><!--sliderA/-->
     <ul class="pronav" >
      @foreach($Category as $v)
      <li cate_id="{{$v->cate_id}}">
        <a href="{{url('prolist/'.$v->cate_id)}}">{{$v->cate_name}}</a>
      </li>
      @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
       @foreach($is_hot as $v)
      <div class="index-pro1-list list" goods_id="{{$v->goods_id}}">
       <dl>
        <dt><a href="{{url('proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="{{url('proinfo/'.$v->goods_id)}}">{{$v->goods_name}}</a></dd><span>库存:{{$v->goods_num}}</span>
        <dd class="ip-price"><strong>￥{{$v->goods_price-100}}</strong> <span>￥{{$v->goods_price}}</span></dd>
       </dl>
      </div>
       @endforeach
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     <div class="prolist">
      @foreach($Goods as $v)
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
     <div class="joins"><a href="fenxiao.html"><img src="/static/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
      @endsection
      

   