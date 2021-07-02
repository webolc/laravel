<?php
namespace App\Http\Controllers\Api\V1;

use App\Library\Rpc\Client AS RpcClient;
use App\Http\Controllers\Api\ApiController;

class LoginController extends ApiController{
    
    public function index(){
        return $this->failed('还未登陆,请先登录');
    }
    public function login(){
        return $this->toRpc(RpcClient::SocketToRpc($this->current_version,'LoginService','login',$this->request->input()));
    }
    public function register(){
        return $this->toRpc(RpcClient::SocketToRpc($this->current_version,'LoginService','register',$this->request->input()));
    }
    public function logout(){
        return $this->toRpc(RpcClient::SocketToRpc($this->current_version,'LoginService','logout',$this->request->input()));
    }
}