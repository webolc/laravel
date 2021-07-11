<?php
namespace App\Services\Request\Login;

class Login{
    
    function rule(){
        return [
            'login_name' => 'required',
            'login_pass' => [
                'required',
                'between:8,20'
            ],
        ];
    }
    
    function message(){
        return [
            'login_name.required'  => '用户名不能为空',
            'login_pass.required'  => '密码不能为空',
            'login_pass.between'   => '密码长度应在8-20位之间'
        ];
    }
    
}