<?php
namespace App\Http\Controllers\Web\V1;

use App\Library\Rpc\Client AS RpcClient;
use App\Http\Controllers\Web\WebController;
use App\Helpers\HttpResponse;

class LoginController extends WebController{
    
    public function index(){
        return $this->view();
    }
    public function login(){
        $res = RpcClient::SocketToRpc($this->current_version,'LoginService','login',$this->request->input());
        $data = $this->getRpcData($res);
        var_dump($data);
        
    }
    public function register(){
        $res = RpcClient::SocketToRpc($this->current_version,'LoginService','register',$this->request->input());
        $data = $this->getRpcData($res);
        var_dump($data);
        
        
    }
    public function logout(){
        $res = RpcClient::SocketToRpc($this->current_version,'LoginService','logout',['user_id'=>$this->request->user()['id']]);
        $data = $this->getRpcData($res);
        
        if ($this->request->method() == 'POST'){
            return $this->toTrait($data);
        }
        if ($data['status'] == HttpResponse::CALL_SUCCESS){
            return $this->redirect(url('/'));
        }
        return $this->redirect(url('/login'));
    }
}