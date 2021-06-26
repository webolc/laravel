<?php
namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Common\V1\LoginTrait;
use App\Http\Controllers\Web\WebController;

class LoginController extends WebController{
    use LoginTrait;
    
    public function index(){
        return $this->view();
    }
    public function login(){
        return $this->toTrait($this->_login());
    }
    public function register(){
        return $this->toTrait($this->_register());
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