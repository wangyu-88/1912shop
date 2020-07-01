<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    public function logindo(Request $request){
    	$post=$request->all();
        // dd($post);
    	//先根据用户名查询记录
    	$admin=Admin::where('admin_name',$post['admin_name'])->first();
    	// dd(decrypt($admin->admin_pwd));
    	if(!$admin){
    		return redirect('/login')->with('msg','用户名或密码错误');
    	}
    	//解密密码跟$post的对比是否一致
    	if(decrypt($admin->admin_pwd)!=$post['admin_pwd']){
    		return redirect('/login')->with('msg','用户名或密码错误');
    	}

    	request()->session()->put('admin',$admin);
        if(isset($post['remember'])){
            //七天免登陆
            Cookie::queue('admin',serialize($admin),60*24*7);
        }
    	// dd($post);
    	return redirect('/brand');
    }
}
