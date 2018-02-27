<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Api\ApiController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Mockery\Exception;


class UserController extends ApiController
{

    public function register ()
    {
        return view('user.register');
    }
    public function isRegistered(Request $request)
    {
        $res = User::isRegistered($request->input('email'));
        if(0==$res){
            return $this->outPutJson(400,'用户已存在');
        }
        return $this->outPutJson(200,'用户名可用');
    }
    public function store (Request $request)
    {
        try{
            $res = User::isRegistered($request->input('email'));
            if(1 == $res){
                return $this->outPutJson(400,'用户已存在');
            }else{
                $redisRes = Redis::sadd('r_username',$request->input('email'));
                if($redisRes){
                    $data = User::create([
                        'password'=>bcrypt($request->input('password')),
                        'email'=>$request->input('email'),
                        'name'=>$request->input('email'),
                    ]);
                    if($data){
                        return $this->outPutJson(200,'成功',$data);
                    }else{//删除缓存
                        Redis::srem('r_username',$request->input('email'));
                    }
                }
            }

        }catch (Exception $exception){
            return $this->outPutJson(500,'注册失败，数据异常');
        }
    }
    public function login ()
    {
        return view('user.login');
    }
    public function signIn(Request $request)
    {
        $user = User::where('email',$request->input('email'))->first();
        if(!isset($user)){
            return $this->outPutJson(500,'用户不存在');
        }
        $res = Hash::check($request->input('password'),isset($user)?$user->password:'');
        if($res)
        {
            session(['user' => $user->name]);
            return $this->outPutJson(200,'登录成功',$user);
        }else{
            return $this->outPutJson(200,'密码错误',$user);
        }
    }
    public function logout(Request $request)
    {
        $request->session()->pull('user');
        return $this->outPutJson(200,'退出登录');
    }
    public function userCenter()
    {
        return view('user.center');
    }
}
