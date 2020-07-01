<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;
//引入缓存
use Illuminate\Support\Facades\Cache;
//引入 Redis
use Illuminate\Support\Facades\Redis;
class ProinfoController extends Controller
{
    //接收首页传过来的id值 详情页
    public function proinfo($id){
    	$res = Goods::find($id);
        // Redis::set("number",1);
        //$name = Redis::get("number");
        //dd($name);
        //点击量
       $redis  =Redis::setnx("count_".$id,1)?:Redis::incr("count_".$id);
      // dd($count);
    	return view("index/proinfo",['res'=>$res,"redis"=>$redis]);
    }
    //商品分类详情页
    public function prolist($id,$type=1){
    	//echo $id;
    	//查询pid为0的数据
    	$category = Category::get();
    	 //无限极分类
        $category = CateTreeArray($category,$id);
		$cate_id = array_column($category,"cate_id");
		array_push($cate_id,$id); 
        //dd($cate_id);
        $Goods = Cache::get("Goods");
        if(!$Goods){
            echo "db==Goods";
            $Goods = Goods::whereIn("cate_id",$cate_id)->orderBy("goods_id","desc")->get();
        //dd($Goods);
            Cache::put("Goods",$Goods,24*24*60);
        }
		
    	return view("index/prolist",["category"=>$category,"Goods"=>$Goods]);
    }
    //全部商品展示 最新
    public function prolists(){
    	//最新
    	$is_new = Goods::where("is_new","=",1)->get();
    	return view("index/prolists",['is_new'=>$is_new]);
    }
    //全部商品展示 最热
    public function prolistss(){
    	//最热
    	$is_hot = Goods::where("is_hot","=",1)->get();
    	return view("index/prolistss",["is_hot"=>$is_hot]);
    }
     //全部商品展示 价格
    public function proprice(){
    	//价格
    	$price = Goods::orderBy("goods_price","desc")->get();
    	return view("index/proprice",["price"=>$price]);
    }
}
