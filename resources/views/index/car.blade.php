@extends('index.layouts.shop')
@section('title', '购物车')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
      <tr>
        <td width="100%" colspan="4"><input type="checkbox" class="all"/> 全选</td>
       </tr>
  @foreach($Goods as $v)
     <div class="dingdanlist">
      <table>
       <tr goods_id = {{$v->goods_id}}>
         <td width="4%"><input type="checkbox" class="box" name="check" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date("Y-m-d H:i:s",$v->is_time)}}</time>
        </td>
        <td align="right"><input type="text" class="spinnerExample" value="{{$v->is_many}}"/></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
       </tr>  
     </table>
     </div><!--dingdanlist/-->
@endforeach
      <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td><hr>
       </tr>
       <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="many">¥0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
      </tr>
      <script>
      //点击全选
      $('.all').click(function(){
        if (this.checked) { //this指当前对象
            $("[name=check]:checkbox").prop("checked", true); 
        }else{
            $("[name=check]:checkbox").prop("checked", false);
        } 
        getMany();
    })
        $(document).on("click",".jiesuan",function(){
          //alert(1);
           var _box = $(".box:checked");
            //console.log(_box);
            if(_box.length==0){
            alert("至少选中一条商品结算");
            return false;
       }
        //获取选中的商品id
        var  goods_id = "";
        _box.each(function(index){
           goods_id += $(this).parents("tr").attr("goods_id")+',';
           //console.log(goods_id);
        })
          goods_id = goods_id.substr(0,goods_id.length-1);
          location.href="/pay?goods_id="+goods_id;
    })

        //定义一个总价方法
       function getMany(){
        //1.获取到选中的复选框
        var _box = $(".box:checked");
        //console.log(box);
        //2.定义一个空字符串把得到的商品id拼接一起
        var  goods_id = "";
        _box.each(function(index){
           goods_id += $(this).parents("tr").attr("goods_id")+',';
           //console.log(goods_id);
        })
          goods_id = goods_id.substr(0,goods_id.length-1);
        //alert(goods_id);
          //location.href="/getMany?goods_id="+goods_id;
        //通过Ajax技术传个控制器
        $.ajax({
            url:"{{url('getMany')}}",
            type:"get",
            data:{goods_id:goods_id},
            //async:"false",
            success:function(res){
              //console.log(res);
                $("#many").html("￥"+res);
            }
        })
    }
    
     

      </script>
     @endsection

