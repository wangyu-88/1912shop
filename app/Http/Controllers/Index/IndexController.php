<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Car;
use App\Category;
//引入缓存
use Illuminate\Support\Facades\Cache;
class IndexController extends Controller
{
    //展示首页
    public function index(){
    	//查询商品一共几条
    	$count = Goods::count();
        //缓存
        // $Goods = Cache::get("Goods");
        // if(!$Goods){
        //     echo "db==Goods";
        //     //显示前五条数据最新的图片  数据
        $Goods = Goods::where("is_new","=",1)->take(5)->get();
        // Cache::put("Goods",$Goods,24*60*60);
        // }
    	// $is_hot = Cache::get("is_hot");
        // if(!$is_hot){
        //     echo "db==is_hot";
        //     //显示热卖的商品
        $is_hot = Goods::where('is_hot',"=",1)->limit("5")->get();
        // Cache::put("is_hot",$is_hot,24*60*60);
        // }
    	
        // $Category = Cache::get("Category");
        // if(!$Category){
        //     echo "db==Category";
        //     //查询pid为0的数据
        $Category = Category::where("parent_id","=",0)->get();
        // Cache::put("Category",$Category,24*60*60);
        // }
    	
    	//dd($Category);
    	 $res = request()->session()->get("admin");
    	 //dd($res);
    	return view("index/index",['res'=>$res,"Goods"=>$Goods,"Category"=>$Category,"is_hot"=>$is_hot,"count"=>$count]);
    }
}
