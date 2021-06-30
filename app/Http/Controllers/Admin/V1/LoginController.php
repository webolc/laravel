<?php
namespace App\Http\Controllers\Admin\V1;

use App\Library\Rpc\Client AS RpcClient;
use App\Http\Controllers\Admin\AdminController;

class LoginController extends AdminController{
    
    public function index(){
        return $this->failed('还未登陆,请先登录');
    }
    public function login(){
        return $this->toRpc(RpcClient::SocketToErp($this->current_version,'LoginService','login',$this->request->input()));
    }
    public function register(){
        return $this->toRpc(RpcClient::SocketToErp($this->current_version,'LoginService','register',$this->request->input()));
    }
    public function logout(){
        return $this->toRpc(RpcClient::SocketToErp($this->current_version,'LoginService','logout',$this->request->input()));
    }
}