<?php
namespace App\Services\Request;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\RpcRequestException;
use App\Helpers\HttpResponse;

class ServiceRequest{
    /**
     * 验证数据
     */
    public function verify($request,$data){
        if (is_object($data)){$data = (array)$data;}
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
                $message = $class->message();
            }
            $validator = Validator::make($data,$rule,$message);
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();
                $error = '';
                $i=1;
                foreach ($errors as $e){
                    $error .=  $i.'、'.implode('，', $e).'；';
                    $i++;
                }
                throw new RpcRequestException($error);
            }
        }else{
            throw new RpcRequestException('验证规则不存在');
        }
    }
}