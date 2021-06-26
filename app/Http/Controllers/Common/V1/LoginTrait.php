<?php
namespace App\Http\Controllers\Common\V1;

trait LoginTrait{
    
    public function _index(){
        return errBack('还未登陆',[],4002);
    }
    /**
     * 获取用户详情
     */
    public function _find(){
        $info = $this->request->user();
        if ($info){
            return succBack('获取成功',$info);
        }
        return errBack('获取失败');
    }
    /**
     * 用户登录
     */
    public function _login(){
        $info = false;
        if ($info){
            return succBack('登录成功',$info);
        }
        return errBack('登录失败');
    }
    /**
     * 用户注册
     */
    public function _register(){
        $info = false;
        if ($info){
            return succBack('注册成功',$info);
        }
        return errBack('注册失败');
    }
    /**
     * 用户退出
     */
    public function _logout(){
        $res = false;
        if ($res){
            return succBack('退出成功');
        }
        return errBack('退出失败');
    }
}