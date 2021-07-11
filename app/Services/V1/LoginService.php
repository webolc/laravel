<?php
namespace App\Services\V1;

use App\Models\User;
use App\Facades\ServiceRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\TokenGuard;

class LoginService{
    
    protected $params;
    public function __construct($params=[]){
        $this->params = $params;
    }
    
    /**
     * 获取用户详情
     */
    public function find(){
        $user_id = $this->params['user_id']??0;
        $info = (new User())->_find($user_id);
        if ($info){
            return succBack('获取成功',$info);
        }
        return errBack('获取失败');
    }
    /**
     * 用户登录
     */
    public function login(){
        ServiceRequest::verify('login.login',$this->params);
        $info = User::query()->where('name','=',$this->params->login_name)->first();
        if (!$info){
            return errBack('账号不存在');
        }
        if (!Hash::check($this->params->login_pass,$info->password)){
            return errBack('密码不正确');
        }
        $info->remember_token = Hash::make($info->password.time());
        $res = $info->save();
        if ($res){
            return succBack('登录成功',$info);
        }
        return errBack('登录失败');
    }
    /**
     * 用户注册
     */
    public function register(){
        $info = false;
        if ($info){
            return succBack('注册成功',$info);
        }
        return errBack('注册失败');
    }
    /**
     * 用户退出
     */
    public function logout(){
        $res = false;
        if ($res){
            return succBack('退出成功');
        }
        return errBack('退出失败');
    }
}