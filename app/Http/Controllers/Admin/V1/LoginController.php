<?php
namespace App\Http\Controllers\Admin\V1;

use App\Library\Rpc\Client AS RpcClient;
use App\Http\Controllers\Admin\AdminController;
use App\Helpers\HttpResponse;

class LoginController extends AdminController{
    
    public function index(){
        return $this->view();
    }
    public function login(){
        $info = $this->getRpcData(RpcClient::SocketToRpc($this->current_version,'LoginService','login',$this->request->input()));
        if ($info['status'] == HttpResponse::CALL_SUCCESS){
            var_dump($info);die;
            cookie('api_token',$info['data']['remember_token']);
            $this->success(['msg'=>'登陆成功']);
        }
        return $this->failed(['msg'=>$info['msg']]);
    }
    public function register(){
        return $this->toRpc(RpcClient::SocketToRpc($this->current_version,'LoginService','register',$this->request->input()));
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