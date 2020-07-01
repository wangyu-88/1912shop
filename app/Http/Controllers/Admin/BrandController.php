<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     * 列表页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //session的使用
        // //存
        // session(['name'=>'lisi']);
        // request()->session()->put('number',100);
        // //取
        // echo session('name');
        // dump(request()->session()->get('number'));
        // //如果没有 设置默认值
        // dump(session('city','beijing'));
        // dump(request()->session()->get('country','中国'));

        // session(['city'=>null]);
        // //检查有没有值
        // dump(request()->session()->has('city'));
        // //检查有没有此键
        // dump(request()->session()->exists('city'));

        // //删除单个
        // dump(request()->session()->forget('number'));
        // //删除所有
        // dump(request()->session()->flush());
        // //获取所有session
        // dump(request()->session()->all());

        // die;

        $page=request()->page??1;
        // echo $page;

        $brand_name=request()->brand_name;
        $where=[];
        // dump($brand_name);
        if($brand_name){
            $where[]=['brand_name','like',"%$brand_name%"];
        }
        // dump('brand_'.$page);
        $brand=Cache::get('brand_'.$page);
        // dump($brand);
        if(!$brand){
            // echo 'DB====';
            //DB操作
            // $brand=DB::table('brand')->orderBy('brand_id','desc')->get();
            // dump($brand);
            
            //orm操作
            $pageSize=config('app.pageSize');
            // DB::connection()->enableQueryLog();
            $brand=Brand::where($where)->orderBy('brand_id','desc')->paginate($pageSize);
            // dd($brand);
            // $log=DB::getQueryLog();
            // dd($log);   
            Cache::put('brand_'.$page,$brand,60);  
        }


        return view('admin.brand.index',['brand'=>$brand,'brand_name'=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     * 添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo '添加页面';
        return view('admin/brand/create');
    }

    /**
     * Store a newly created resource in storage.
     *  执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //第二种表单验证
    // public function store(StoreBrandPost $request)
    public function store(Request $request)
    {
        //第一种表单验证
        // $validatedData = $request->validate([
        //     'brand_name' => 'required|unique:brand',
        //     'brand_url' => 'required',
        // ],[
        //     'brand_name.required'=>'品牌名称必填',
        //     'brand_name.unique'=>'品牌名称已存在',
        //     'brand_url.required'=>'品牌网址必填',
        // ]);  

        //第三种表单验证
        $validator = Validator::make($request->all(),[
            // 'brand_name' => 'required|unique:brand',
            'brand_name' => 'regex:/^[\x{4e00}-\x{9fa5}\w-]{2,15}$/u|unique:brand',
            'brand_url' => 'required',
        ],[
            'brand_name.regex'=>'品牌名称需由中文，字母，数字，下划线长度2-15位组成',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_url.required'=>'品牌网址必填',
        ]);
        if ($validator->fails()) {
            return redirect('brand/create')
            ->withErrors($validator)
            ->withInput();
        }


        $brand=$request->except('_token');
        // dd($brand);
        //判断有无文件上传
        // dd($request->hasFile('brand_logo'));
        if($request->hasFile('brand_logo')){
            //文件上传
            $brand_logo=upload('brand_logo');
            // dd($img);

        }

        //DB操作
        // $res=DB::table('brand')->insert($brand);
        //dd($res);

        //orm操作
        $brand=new Brand;
        $brand->brand_name=$request->brand_name;
        $brand->brand_url=$request->brand_url;
        if(isset($brand_logo)){
            $brand->brand_logo=$brand_logo;
        }
        $brand->brand_desc=$request->brand_desc;
        $res=$brand->save();

        if($res){
            return redirect('brand');
        }
    }
    

    /**
     * Display the specified resource.
     * 预览详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //DB操作
        // $brand=DB::table('brand')->where('brand_id',$id)->first();
        //orm操作
        // $brand=Brand::find($id);
        $brand=Brand::where('brand_id',$id)->first();
        return view('admin/brand/edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     * 执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //第二种表单验证
    //public function update(StoreBrandPost $request, $id)
    public function update(Request $request, $id)
    {
        //第一种表单验证
        // $validatedData = $request->validate([
        //     // 'brand_name' => 'required|unique:brand',
        //     'brand_name' => [
        //         'required',
        //         Rule::unique('brand')->ignore($id,'brand_id')
        //     ],
        //     //'brand_url' => 'required',
        //     'brand_url' => [
        //         'required',
        //         Rule::unique('brand')->ignore($id,'brand_url')
        //     ],
        // ],[
        //     'brand_name.required'=>'品牌名称必填',
        //     'brand_name.unique'=>'品牌名称已存在',
        //     'brand_url.required'=>'品牌网址必填',
        //     'brand_url.unique'=>'品牌网址已存在',
        // ]); 

        //第三种表单验证
        $validator = Validator::make($request->all(),[
            'brand_name' => [
                'required',
                Rule::unique('brand')->ignore($id,'brand_id')
            ],
            'brand_url' => [
                'required',
                Rule::unique('brand')->ignore($id,'brand_url')
            ],
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_url.required'=>'品牌网址必填',
            'brand_url.unique'=>'品牌网址已存在',
        ]);
        if ($validator->fails()) {
            return redirect('brand/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }

        // $brand=$request->except('_token');
        //判断有无文件上传
        if($request->hasFile('brand_logo')){
            //文件上传
            $brand_logo=upload('brand_logo');
        }

        //DB操作
        // $res=DB::table('brand')->where('brand_id',$id)->update($brand);
        // dd($res);
        
        //orm操作
        $brand=Brand::find($id);
        $brand->brand_name=$request->brand_name;
        $brand->brand_url=$request->brand_url;
        if(isset($brand_logo)){
            $brand->brand_logo=$brand_logo;
        }
        $brand->brand_desc=$request->brand_desc;
        $res=$brand->save();

        if($res!==false){
            return redirect('brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     * 删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //DB操作
        // $res=DB::table('brand')->where('brand_id',$id)->delete();

        //orm操作
        $res =Brand::destroy($id);
        // dd($res);

        if($res){
            // return redirect('brand');
            echo json_encode(['code'=>'0','msg'=>'删除成功！']);exit;
        }
    }
    public function checkname(){
        $brand_name=request()->brand_name;
        // echo $brand_name;
        $count=Brand::where('brand_name',$brand_name)->count();
        return json_encode(['code'=>'00000','count'=>$count]); 
    }
}
