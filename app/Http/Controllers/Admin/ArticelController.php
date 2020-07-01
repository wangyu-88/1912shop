<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Articel as ArticelModel;
use App\Cate as CateModel;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Validation\Rule;
class ArticelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title=request()->title;
        $c_name=request()->c_name;
        $where=[];
        // dump($title);
        if($title){
            $where[]=['title','like',"%$title%"];
        }
        if($c_name){
            $where[]=['c_name','like',"%$c_name%"];
        }

        //分页
        $pageSize=config('app.pageSize');
        //展示
        $articel=ArticelModel::select('articel.*','cate.c_name')
        ->leftjoin('cate','articel.c_id','=','cate.c_id')
        ->where($where)
        ->paginate($pageSize);
        $cate=CateModel::get();
        return view('admin.articel.index',['articel'=>$articel,'cate'=>$cate,'title'=>$title,'c_name'=>$c_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加表单
        $cate=CateModel::get();
        return view('admin/articel/create',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加
        //表单验证
        $validatedData = $request->validate([
            'title' => 'required|unique:articel',
            'c_id' => 'required',
            'importance' => 'required',
            'is_show' => 'required',
        ],[
            'title.required'=>'文章名称必填',
            'title.unique'=>'文章名称已存在',
            'c_id.required'=>'文章分类必填',
            'importance.required'=>'文章重要性必选',
            'is_show.required'=>'是否显示必选',
        ]);

        $articel=$request->except('_token');
        // dd($articel);
        //判断有无文件上传
        // dd($request->hasFile('img'));
        if($request->hasFile('img')){
            //文件上传
            $img=upload('img');
            // dd($img);

        }

        //DB操作
        // $res=DB::table('articel')->insert($articel);
        //dd($res);

        //orm操作
        $articel=new ArticelModel;
        $articel->title=$request->title;
        $articel->c_id=$request->c_id;
        $articel->importance=$request->importance;
        $articel->is_show=$request->is_show;
        $articel->writer=$request->writer;
        $articel->email=$request->email;
        $articel->keywords=$request->keywords;
        $articel->desc=$request->desc;

        if(isset($img)){
            $articel->img=$img;
        }
        
        $res=$articel->save();

        if($res){
            return redirect('articel');
        }
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
        $cate=CateModel::get();
        $articel=ArticelModel::find($id);
        return view('admin/articel/edit',['articel'=>$articel,'cate'=>$cate]);
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
        //执行修改
        //表单验证
        $validatedData = $request->validate([
            'title' => 'required|unique:articel',
            'c_id' => 'required',
            'importance' => 'required',
            'is_show' => 'required',
        ],[
            'title.required'=>'文章名称必填',
            'title.unique'=>'文章名称已存在',
            'c_id.required'=>'文章分类必填',
            'importance.required'=>'文章重要性必选',
            'is_show.required'=>'是否显示必选',
        ]);

        $articel=$request->except('_token');
        // dd($articel);
        //判断有无文件上传
        // dd($request->hasFile('img'));
        if($request->hasFile('img')){
            //文件上传
            $img=upload('img');
            // dd($img);

        }

        $articel=ArticelModel::find($id);

        //orm操作
        $articel=new ArticelModel;
        $articel->title=$request->title;
        $articel->c_id=$request->c_id;
        $articel->importance=$request->importance;
        $articel->is_show=$request->is_show;
        $articel->writer=$request->writer;
        $articel->email=$request->email;
        $articel->keywords=$request->keywords;
        $articel->desc=$request->desc;

        if(isset($img)){
            $articel->img=$img;
        }
        
        $res=$articel->save();
        // dd($res);
        if($res!==false){
            return redirect('articel');
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
        //orm操作
        $res =ArticelModel::destroy($id);
        // dd($res);

        if($res){
            // return redirect('articel');
            echo json_encode(['code'=>'0','msg'=>'删除成功！']);exit;
        }
    }
}
