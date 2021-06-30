<?php
namespace App\Services\V1;

class LoginService{
    /**
     * 获取用户详情
     */
    public function find(){
        $info = $this->request->user();
        if ($info){
            return succBack('获取成功',$info);
        }
        return errBack('获取失败');
    }
    /**
     * 用户登录
     */
    public function login(){
        $info = false;
        if ($info){
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