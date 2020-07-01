<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //展示我的
    public function user(){
    	//判断用户是否登录
    	$admin = request()->session()->get("member");
    	if(!$admin){
    		  return redirect("login")->with("msge","请先登录");return;
    	}
    	
    	//dump($admin);
    	return view("index/user",['admin'=>$admin]);
    }
    //待付款
    public function order(){
        return view("index/order");
    }
    //我的优惠券
    public function quan(){
        return view("index/quan");
    }
    //收货地址管理
    public function addaddress(){
        return view("index/addaddress");
    }
    //我的收藏
    public function shoucang(){
        return view("index/shoucang");
    }
    //余额提现
    public function tixian(){
        return view("index/tixian");
    }
}


