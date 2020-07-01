<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
	//学生添加
	public function list(){
    	echo '学生列表';
    }
    //添加
    public function create(Request $request){
        //判断请求方式 是否是post
        $method=$request->method();
        dump($method);
        if($method=='POST'){
            $post=request()->all();
            // dump($post);
            // dd($post);

            //接收值入库
            //code
            return redirect('/index');

        }
    	return view('create',['name'=>'王宇3']);
    }
    //接值
    public function store(Request $request){
    	$post=request()->all();
    	print_r($post);
    }

    public function add(){
    	//添加
    	$arr=array(1,2,3,4,5);
    	print_r($arr);
    	// $arr2=array('90');
    	// array_splice($arr,2,0,$arr2);
    	// print_r($arr);

    	//删除
    	// unset($arr[3]);
    	// print_r($arr);
    }
    public function user($id,$name){
        echo '控制器的方法:'.$id;
        echo $name;
    }
}
