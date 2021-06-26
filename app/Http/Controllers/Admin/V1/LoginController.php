<?php
namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Common\V1\LoginTrait;
use App\Http\Controllers\Common\CommonController;

class LoginController extends CommonController{
    use LoginTrait;
    
    public function index(){
        return $this->toTrait($this->_index());
    }
    public function login(){
        return $this->toTrait($this->_login());
    }
    public function register(){
        return $this->toTrait($this->_register());
    }
    public function logout(){
        return $this->toTrait($this->_logout());
    }
}