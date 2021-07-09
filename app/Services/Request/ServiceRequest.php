<?php
namespace App\Services\Request;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\RpcRequestException;

class ServiceRequest{
    /**
     * 验证数据
     */
    public function verify($request,$data){
        $request = explode('.', $request);
        $request = array_map('ucfirst', $request);
        $request = 'App\\Services\\Request\\'.implode('\\', $request);
        if (class_exists($request)){
            $class = new $request();
            $rule = $message = [];
            if (method_exists($class,'rule')){
                $rule = $class->rule();
            }
            if (method_exists($class,'message')){
                $rule = $class->message();
            }
            $validator = Validator::make($data,$rule,$message);
            if ($validator->fails()) {
                throw new RpcRequestException($validator->errors());
            }
        }else{
            throw new RpcRequestException('验证规则不存在');
        }
    }
}