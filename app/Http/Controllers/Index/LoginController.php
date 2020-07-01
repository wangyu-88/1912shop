<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
use App\Member;
class LoginController extends Controller
{
	// 用户登录名称 wangyu@1482632405645608.onaliyun.com
	// AccessKey ID LTAI4G7UYdcf7wkjU4QBMKac
	// SECRET 1XC87eid0aqFVFx41l0ViGJI9ohzHE
    public function login(){
    	return view('index.login');
    }
    public function reg(){
    	return view('index.reg');
    }
    public function send(Request $request){
    	$name=$request->name;
    	// echo $name;
    	//判断name是手机号还是邮箱
    	$reg='/^1[3|4|5|6|7|8|9]\d{9}$/';
    	$reg_email="/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/";
        $code=rand(1000,9999);
    	if(preg_match($reg,$name)){
    		//手机发送验证码
            $res=$this->sendSms($name,$code);
            // $res['Message']=='OK';
            if($res['Message']=='OK'){
                $request->session()->put('code',$code);
                return json_encode(['code'=>'00000','msg'=>'发送成功']);
            }
    		// echo 'mobile';
    	}elseif(preg_match($reg_email,$name)){
    		//邮箱发送验证码
    		$this->sendMail($name,$code);
            $request->session()->put('code',$code);
            return json_encode(['code'=>'00000','msg'=>'发送成功']);
    	}else{
    		return json_encode(['code'=>'00000','msg'=>'请输入正确的手机号或者邮箱']);
    	}
    }

    public function sendMail($mail,$code){
       return Mail::to($mail)->send(new SendCode($code));
    }

    public function sendSms($mobile,$code){
        // Download：https://github.com/aliyun/openapi-sdk-php
        // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

        AlibabaCloud::accessKeyClient('LTAI4G7UYdcf7wkjU4QBMKac', '1XC87eid0aqFVFx41l0ViGJI9ohzHE')
                                ->regionId('cn-hangzhou')
                                ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                  ->product('Dysmsapi')
                                  // ->scheme('https') // https | http
                                  ->version('2017-05-25')
                                  ->action('SendSms')
                                  ->method('POST')
                                  ->host('dysmsapi.aliyuncs.com')
                                  ->options([
                                                'query' => [
                                                  'RegionId' => "cn-hangzhou",
                                                  'PhoneNumbers' => $mobile,
                                                  'SignName' => "芋泥波波奶茶",
                                                  'TemplateCode' => "SMS_190720197",
                                                  'TemplateParam' => "{code:$code}",
                                                ],
                                            ])
                                  ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }

    }

    //执行注册
    public function doreg(Request $request){
        $post=$request->except('_token');
        // dump($post);

        $code=$request->session()->get('code');
        // dd($code);

        //验证验证码是否正确
        // if($post['code']!=$code){
        //     return redirect('/reg')->with('msg','验证码有误');
        // }
        //判断两次密码是否一致
        if($post['password']!=$post['repassword']){
            return redirect('/reg')->with('msg','两次密码不一致');
        }
        //入库
        $reg='/^1[3|4|5|6|7|8|9]\d{9}$/';
        $reg_email="/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/";
        if(preg_match($reg,$post['name'])){
            $post['moblie']=$post['name'];
        }elseif(preg_match($reg_email,$post['name'])){
            $post['email']=$post['name'];
        }else{
            return redirect('/reg')->with('msg','您的手机号或邮箱有误');
        }

        $post['password']=encrypt($post['password']);
        unset($post['repassword']);
        unset($post['code']);
        // dd($post);
        $res=Member::create($post);
        // dd($res);
        if($res){
            return redirect('/login');
        }
    }


    //执行登录
    public function dologin(Request $request){
        $post = $request->all();
        //dd($post);
        $member = Member::where("name",$post["name"])->first();
        //判断账号是否存在
        if(!$member){
            return redirect("login")->with("msg","用户名或密码错误");
        }
        //如果存在解密密码 如果密码错误 给出提示
        if(decrypt($member->password)!=$post["password"]){
            return redirect("login")->with("msg","用户名或密码错误");
        }
        //存session
        request()->session()->put("member",$member);
        return redirect("index");
    }
}
