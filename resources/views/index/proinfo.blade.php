@extends('index.layouts.shop')
@section('title', '详情')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      <img src="{{env('UPLOADS_URL')}}{{$res->goods_img}}" >
     </div><!--sliderA/-->
     <table class="jia-len">
      <th>浏览量：{{$redis}}</th>
      <tr>
       <th><strong class="orange">￥{{$res->goods_price}}</strong></th>
       
       <td>
        <!-- <button class="decrease spinnerExample">-</button> -->
        <input type="text" class="spinnerExample" name = "is_many"/>
        <!-- <input type="text" class="increase spinnerExample"> -->
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$res->goods_name}}</strong>
        <p class="hui">{{$res->goods_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix" ></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="{{env('UPLOADS_URL')}}{{$res->goods_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="{{url('index')}}"><span class="glyphicon glyphicon-home btn btn-success">返回首页</span></a>&nbsp;
       </th>
       <td>
        <button><a href="javascript:;"  class="btn btn-success" name="button">加入购物车</a></button>
       </td>
      </tr>
     </table>
    </div><!--maincont-->
 <script>
  $("button").click(function(){
     var is_many = $(".spinnerExample").val();
     var goods_id = "{{$res->goods_id}}";
     var goods_num = "{{$res->goods_num}}";
     //alert(goods_id);
      $.ajax({
        url:"{{url('car')}}",
        type:"get",
        data:{goods_id:goods_id,is_many:is_many},
        dataType:"json",
        success:function(res){
         //console.log(res);
         if(res.code=="00000"){ 
          alert(res.msg);
          location.href="{{url('login')}}";return;
          }else if(res.code=="11111"){
            alert(res.msg);
            location.href="{{url('carlist')}}";
          }else if(res.code=="22222"){
            alert(res.msg);
          }else if(res.code==="33333"){
            alert(res.msg);
              location.href="{{url('carlist')}}";
          }
        }
        
      })
      $("form").submit();
    
  })


</script>
  @endsection
