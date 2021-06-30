<?php
namespace App\Http\Controllers\Web\V1;

use App\Library\Rpc\Client AS RpcClient;
use App\Http\Controllers\Web\WebController;

class LoginController extends WebController{
    
    public function index(){
        return $this->view();
    }
    public function login(){
        return $this->toRpc(RpcClient::SocketToErp($this->current_version,'LoginService','login',$this->request->input()));
    }
    public function register(){
        return $this->toRpc(RpcClient::SocketToErp($this->current_version,'LoginService','register',$this->request->input()));
    }
    public function logout(){
        $res = $this->_logout();
        if ($this->request->method() == 'POST'){
            return $this->toTrait($res);
        }
        if ($res){
            $this->redirect(url('/'));
        }
        $this->redirect(url('/login'));
    }
}