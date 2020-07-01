<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//闭包路由
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/index', function () {
// 	echo 'hello php';
// });
// Route::get('/ddd', function () {
// 	echo '1912 Good';
// });
//路由重定向 301：永久重定向，对seo优化比较友好  302：临时重定向，对搜索引擎不好
// Route::redirect('/index','ddd',301);
// Route::permanentRedirect('/index','ddd');

//控制器路由
//get方式
// Route::get('/test','TestController@index');
// Route::get('/adddo','TestController@adddo');

// Route::get('/list','StudentController@list');
// Route::get('/create','StudentController@create');
// Route::post('/store','StudentController@store');

//一个路由支持多种请求方式
// Route::match(['get','post'],'/create','StudentController@create');
// Route::any('/create','StudentController@create');

//路由试图
// Route::view('aaa','create',['name'=>'王宇']);
// Route::get('/bbbb', function () {
// 	return view('create',['name'=>'王宇2']);
// });
// Route::get('/ccc','StudentController@create');


// Route::get('/add','StudentController@add');

//路由传参
// Route::get('user', function () {
// 	return '没有参数';
// });
// 必填参数
// Route::get('user/{id}', function ($id) {
// 	return 'User ' . $id;
// });
//Route::get('user/{id}/{name}','StudentController@user');

//可选参数
// Route::get('category/{cate_id?}', function ($cate_id =0) {
// 	return '分类id：'.$cate_id;
// });

//正则约束
// Route::get('user/{id}','StudentController@user')->where('id','\d+');
// Route::get('user/{id}/{name}','StudentController@user')->where(['id'=>'\d+','name'=>'[a-zA-Z][2,12]']);

// Route::get('setcookie','TestController@setcookie');
// Route::get('getcookie','TestController@getcookie');

//品牌模块的增删改查
Route::prefix('brand')->middleware('islogin')->group(function(){
	Route::get('/','Admin\BrandController@index');//列表
	Route::get('create','Admin\BrandController@create');//添加
	Route::post('store','Admin\BrandController@store');//执行添加
	Route::get('destroy/{id}','Admin\BrandController@destroy');//删除
	Route::get('edit/{id}','Admin\BrandController@edit');//编辑
	Route::post('update/{id}','Admin\BrandController@update');//执行编辑
	Route::get('/checkname','Admin\BrandController@checkname');//列表
});

//学生模块增删改查
Route::prefix('student')->middleware('islogin')->group(function(){
	Route::get('/','Admin\StudentController@index');//列表
	Route::get('create','Admin\StudentController@create');//添加
	Route::post('store','Admin\StudentController@store');//执行添加
	Route::get('destroy/{id}','Admin\StudentController@destroy');//删除
	Route::get('edit/{id}','Admin\StudentController@edit');//编辑
	Route::post('update/{id}','Admin\StudentController@update');//执行编辑
});

//微商城后台
Route::domain('www.1912laravel.com')->group(function(){
	//商品管理路由分组管理
	Route::prefix("goods")->middleware("islogin")->group(function(){
		//展示添加
		Route::get('goods','Admin\GoodsController@create');
		//接收添加
		Route::post('store','Admin\GoodsController@store');
		//跳转展示
		Route::get("index",'Admin\GoodsController@index');
		//删除传参
		Route::get("destroy/{id}",'Admin\GoodsController@destroy');
		//展示修改
		Route::get("edit/{id}",'Admin\GoodsController@edit');
		//执行修改
		Route::post("update/{id}",'Admin\GoodsController@update');	
		//ajax验证添加唯一性
		Route::get("checkname",'Admin\GoodsController@checkname');
		//批量删除
		Route::get("checkdel",'Admin\GoodsController@checkdel');
	});

	//分类模块增删改查
	Route::prefix('category')->middleware('islogin')->group(function(){
		Route::get('/','Admin\CategoryController@index');//列表
		Route::get('/create','Admin\CategoryController@create');//添加
		Route::post('/store','Admin\CategoryController@store');//执行添加
		Route::get('/destroy/{id}','Admin\CategoryController@destroy');//删除
	});

	//后台登录
	Route::view('/login','admin.login');
	Route::post('/logindo','Admin\LoginController@logindo');//执行登录

	//管理员模块增删改查
	Route::prefix('admin')->middleware('islogin')->group(function(){
		Route::get('/','Admin\AdminController@index');//列表
		Route::get('/create','Admin\AdminController@create');//添加
		Route::post('/store','Admin\AdminController@store');//执行添加
		Route::get('/destroy/{id}','Admin\AdminController@destroy');//删除
		Route::get('edit/{id}','Admin\AdminController@edit');//编辑
		Route::post('update/{id}','Admin\AdminController@update');//执行编辑
	});
});

//前台展示
// Route::domain('www.laravel.com')->group(function(){
// 	Route::post('dologin','Index\IndexController@dologin');//执行登录
// 	Route::get('/login','Index\LoginController@login');//前台登录
// 	Route::get('/reg','Index\LoginController@reg');//前台注册
// 	Route::get('/send','Index\LoginController@send');
// 	Route::post('/doreg','Index\LoginController@doreg');
// });


//域名分组管理 www.1912.com 前台  admin.1912.com  后台
Route::domain("www.laravel.com")->group(function(){
//前台
//展示首页->middleware("islogin")
Route::get('index','Index\IndexController@index');
//展示登录
Route::get('login','Index\LoginController@login');
//执行登录
Route::post('dologin','Index\LoginController@dologin');
//展示注册
Route::get('reg','Index\LoginController@reg');
//执行注册
Route::post('regs','Index\LoginController@regs');
//执行退出
Route::match(["post","get"],'quit','Index\LoginController@quit');
//执行详情
Route::match(["post","get"],'list','Index\ProinfoController@list');
//接收首页传到详情页的id
Route::match(["post","get"],'proinfo/{id}','Index\ProinfoController@proinfo');
Route::match(["post","get"],'prolist/{id}','Index\ProinfoController@prolist');
//全部商品  最新
Route::match(["post","get"],'prolists','Index\ProinfoController@prolists');
//全部商品  最热
Route::match(["post","get"],'prolistss','Index\ProinfoController@prolistss');
//全部商品  价格
Route::match(["post","get"],'proprice','Index\ProinfoController@proprice');
//我的
Route::match(["post","get"],'user','Index\UserController@user');
//我的  待付款
Route::match(["post","get"],'order','Index\UserController@order');
//我的  优惠券
Route::match(["post","get"],'quan','Index\UserController@quan');
//我的  收货地址
Route::match(["post","get"],'addaddress','Index\UserController@addaddress');
//我的  收藏   待浏览记录
Route::match(["post","get"],'shoucang','Index\UserController@shoucang');
//我的  余额提现
Route::match(["post","get"],'tixian','Index\UserController@tixian');
//添加购物车  传id
Route::match(["post","get"],'car','Index\CarController@car');
// //展示购物车  传id
Route::match(["post","get"],'carlist','Index\CarController@carlist');
// //去结算 
Route::match(["post","get"],'pay','Index\PayController@pay');
// //去结算  总价 
Route::match(["post","get"],'getMany','Index\CarController@getMany');
// //提交订单
Route::match(["post","get"],'success','Index\PayController@success');
//购物车  传购买数量
//Route::match(["post","get"],'is_many/{id}','Index\CarController@car');
//ajax传给后台手机号验证
Route::match(['post','get'],'tele','Index\LoginController@tele');

});


//文章增删改查
Route::prefix('articel')->middleware('islogin')->group(function(){
	Route::get('/','Admin\ArticelController@index');//列表
	Route::get('/create','Admin\ArticelController@create');//添加
	Route::post('/store','Admin\ArticelController@store');//执行添加
	Route::get('/destroy/{id}','Admin\ArticelController@destroy');//删除
	Route::get('edit/{id}','Admin\ArticelController@edit');//编辑
	Route::post('update/{id}','Admin\ArticelController@update');//执行编辑
});



