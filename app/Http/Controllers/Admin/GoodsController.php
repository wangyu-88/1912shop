<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\Category;
use Validator;//第三种表单验证
use Illuminate\Validation\Rule;//第三种表单验证
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$brand_id = Brand::all();
        $category  = Category::all();
        //接搜索的值
        $goods_name = request()->goods_name;
        $where = [];
        if($goods_name){
            $where[] = ["goods_name","like","%$goods_name%"];
        }
        $pageSize=config('app.pageSize');
        $goods = Goods::
        leftjoin("brand","goods.brand_id","=","brand.brand_id")
        ->leftjoin("category","goods.cate_id","=","category.cate_id")
        ->where($where)->orderBy("goods_id",'desc')->paginate($pageSize);
        //dd($goods);
        return view("admin/goods/index",["goods"=>$goods,"goods_name"=>$goods_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $brand_id = Brand::all();
       $category  = Category::all();
       //无限极分类
       $category = createTree($category);
       return view("admin/goods/create",["brand_id"=>$brand_id,"category"=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //第三种表单验证  手册第330页-331页
        $validator = Validator::make($request->all(),
        [
            'goods_name' => 'regex:/^[\u4e00-\u9fa5\w]{2,15}$/u|unique:goods', //名称不能为空 唯一性验证
            'goods_price' => 'regex:/^\d{1,10}$/',//价格不能为空
           // 'goods_price' => 'required',
            'goods_num' => 'regex:/^\d{1,5}$/',//库存不能为空
            //'goods_num' => 'required',//库存不能为空
            //'goods_score' => 'required',//积分不能为空
            //'goods_desc' => 'required',//介绍不能为空
        ],[
            //转换为中文提示
            "goods_name.regex"=>"商品名称需由中文、字母、数字、下划线长度2-15位组成",
            "goods_name.unique"=>"商品名称已存在",
            'goods_price.regex' =>'价格不能为空,商品价格纯数字,长度1-10位组成',//价格不能为空
            'goods_num.regex' =>'库存不能为空,商品库存纯数字,长度1-5位组成',//库存不能为空
            //'goods_score.required' =>'积分不能为空',//积分不能为空
            //'goods_desc.required' =>'介绍不能为空',//介绍不能为空
            
        ]);
        if ($validator->fails()) {//判断是否执行过验证 手册第330页-331页
            return redirect('goods/goods')//跳地址
            ->withErrors($validator)
            ->withInput();
            }
        //文件上传
        if($request->hasFile("goods_img")){
            $goods_img = $this->upload("goods_img");
        }
        $goods = new Goods;
        $goods->goods_name = $request->goods_name;
        $goods->goods_price = $request->goods_price;
        $goods->goods_desc = $request->goods_desc;
        $goods->goods_num = $request->goods_num;
        $goods->goods_score = $request->goods_score;
        if(isset($goods_img)){
             $goods->goods_img = $goods_img;
        }
        $goods->goods_imgs = $request->goods_imgs;
        $goods->is_new = $request->is_new;
        $goods->is_hot = $request->is_hot;
        $goods->is_best = $request->is_best;
        $goods->is_up = $request->is_up;
        $goods->brand_id = $request->brand_id;
        $goods->cate_id = $request->cate_id;
        $res = $goods->save();
        if($res){
            return redirect("goods/index");
        }

    }
    //文件上传
    public function upload($fileimg){
        $file = request()->file($fileimg);
        if($file->isValid()){
            $path = $file->store("uploads");
            return $path;
        }
        exit("文件上传错误");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $goods = Goods::find($id);
       $brand_id = Brand::all();
       $category  = Category::all();
       //无限极分类
       $category = createTree($category);
       return view("admin/goods/edit",["brand_id"=>$brand_id,"category"=>$category,"goods"=>$goods]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          //第三种表单验证  手册第330页-331页
        $validator = Validator::make($request->all(),
        [
            'goods_name' => [
            'required',
             Rule::unique('goods')->ignore($id,'goods_id'),//强制一个忽略给定 ID  手册第356页
            ], //名称不能为空 唯一性验证
            'goods_price' => 'required',//价格不能为空
            'goods_num' => 'required',//库存不能为空
            'goods_score' => 'required',//积分不能为空
            'goods_desc' => 'required',//介绍不能为空
        ],[
            //转换为中文提示
            "goods_name.required"=>"商品名称必填",
            "goods_name.unique"=>"商品名称已存在",
            'goods_price.required' =>'价格不能为空',//价格不能为空
            'goods_num.required' =>'库存不能为空',//库存不能为空
            'goods_score.required' =>'积分不能为空',//积分不能为空
            'goods_desc.required' =>'介绍不能为空',//介绍不能为空
            
        ]);
        if ($validator->fails()) {//判断是否执行过验证 手册第330页-331页
            return redirect('goods/edit/'.$id)//跳地址
            ->withErrors($validator)
            ->withInput();
            }

          //文件上传
        if($request->hasFile("goods_img")){
            $goods_img = $this->upload("goods_img");
        }
        $goods = Goods::find($id);
        $goods->goods_name = $request->goods_name;
        $goods->goods_price = $request->goods_price;
        $goods->goods_desc = $request->goods_desc;
        $goods->goods_num = $request->goods_num;
        $goods->goods_score = $request->goods_score;
        if(isset($goods_img)){
            $goods->goods_img = $goods_img;
        }
        $goods->goods_imgs = $request->goods_imgs;
        $goods->is_new = $request->is_new;
        $goods->is_hot = $request->is_hot;
        $goods->is_best = $request->is_best;
        $goods->is_up = $request->is_up;
        $goods->brand_id = $request->brand_id;
        $goods->cate_id = $request->cate_id;
        $res = $goods->save();
        if($res){
            return redirect("goods/index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goods = Goods::destroy($id);
        return redirect("goods/index");
    }
    public function checkname(){
        $goods_name = request()->goods_name;
        $count =  Goods::where("goods_name",$goods_name)->count();
        return json_encode(["code"=>"1","count"=>$count]);
    }
    //批量删除
    public function checkdel(){
        $goods_id = request()->goods_id;
        $str = explode(",",$goods_id);
        //利用循环将需要删除的id 一个一个进行执行sql；
        foreach($str as $v){
        $deletes = Goods::where('goods_id',"=","$v")->delete();
        //return json_encode(["code"=>"1","deletes"=>$deletes]);
        }
    }
}
