<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Car;
use App\Goods;
//引入缓存 Cache
use Illuminate\Support\Facades\Cache;
//引入 Redis
use Illuminate\Support\Facades\Redis;
class CarController extends Controller
{
	//展示购物车
	public function carlist(){
     $admin = session("member");
     // dd($admin);
    //判断用户是否登录
      if(!$admin){
          return redirect("login");
      }
      //删除单个
       // Redis::del("Goods");
     // $Goods = Cache::get("Goods");
      $Goods = Redis::get("Goods");
      
      //dd($Goods);
      // if(!$Goods){
      //   echo "db==Goods";
          $Goods = Car::orderBy("goods_id","desc")->get();
      //     //dd($Goods);
      //     //Cache::put("Goods",$Goods,24*24*60);
      //     $Goods = serialize($Goods);
      //     // dump($Goods);
      //     Redis::setex("Goods",24*24*60,$Goods);
      // }
		    // $Goods = unserialize($Goods);
        $count = Car::count();
		// dump($count);
	 	return view("index/car",["Goods"=>$Goods,"count"=>$count]);
  	 } 

    //添加购物车
    public function car(){
    	$admin = session("member");
        $is_many = request()->is_many;
        $goods_id = request()->goods_id;
        $admin_id = $admin["m_id"];
    	//判断用户是否登录
    	if(!$admin){
    		  return json_encode(["code"=>"00000","msg"=>"请先登录"]);return;
    	}
        
      //判断购买数量是否大于库存
            $ee  =  Goods::find($goods_id)->value("goods_num");;
            //rray_column($ee,"goods_num");
           if($is_many>$ee){
           return json_encode(["code"=>"22222","msg"=>"购买数量大于库存"]);return;
           }
     //如果添加的同一条数据 购买数量增加
              $where =  [
                    ["goods_id","=",$goods_id],
                    ["admin_id","=",$admin_id],
                    ["is_del","=",1],
                  ]; 
            $aa = Car::where($where)->value("is_many");
            $ee  =  Goods::find($goods_id)->value("goods_num");;
            //array_column($aa,"is_many");
            //echo $aa;
            $Checknum = $aa+$is_many;
             if($Checknum>$ee){
             $Checknum = $ee;//累加最大值为库存
            }
            //修改数据库购买数量
           $Checkupd = Car::where($where)->update(['is_many'=>$Checknum,'is_time'=>time()]);
            if($Checkupd){
               return json_encode(["code"=>"33333","msg"=>"添加购物车成功"]); 
            }

    	$car = new Car;
      // $Goods = Cache::get("Goods");
      // $Goods = Redis::get("Goods");
      // if(!$Goods){
      //   echo "db==Goods";
          $Goods = Goods::select("goods_price","goods_name","goods_img","goods_num")->find($goods_id)->toArray();
          Cache::put("Goods",$Goods,24*60*60);
      //     // dd($Goods);
      //     $Goods = serialize("Goods");
      //     Redis::setex("Goods",24*60*60,$Goods);
      // }
      // $Goods = unserialize($Goods);
    	$arr = [
                "is_many"=>$is_many,
                "goods_id"=>$goods_id,
                "admin_id"=>$admin_id,
                "is_time"=>time(),
                "goods_name"=>$Goods["goods_name"],
                "goods_price"=>$Goods['goods_price'],
                "goods_img"=>$Goods["goods_img"],
                "goods_num"=>$Goods["goods_num"]
              ];

    	   $res = $car->insert($arr);
            return json_encode(["code"=>"11111","msg"=>"添加购物车成功"]);
    }
   //重新计算总价
    public function getMany(){
    $goods_id = request()->goods_id;
      $admin = session("admin");
      $admin_id = $admin["m_id"];
     $where =  [
                    ["goods_id","=",$goods_id],
                    ["admin_id","=",$admin_id],
                    ["is_del","=",1],
                  ]; 
     $res = Car::select("goods_price","is_many")->where($where)->get();
       //循环 让单价*购买数量 相加
        //定义一个总价为0
        $many = 0;
        foreach($res as $k=>$v){
           $many += $v["goods_price"] * $v["is_many"];
        }
        echo $many;
    }

}
