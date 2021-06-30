<?php 
namespace App\Library\Rpc;

use App\Library\Thrift\ThriftCommonCallServiceIf;
use App\Library\Thrift\Response;

class Server implements ThriftCommonCallServiceIf
{
    private $versions= ['V1'];
    /**
     * 实现 socket 各个service 之间的转发
     * @param string $params
     * @return Response
     * @throws \Exception
     */
    public function invokeMethod($params)
    {
        // 转换字符串 json
        $params = json_decode($params);
        $response = new Response();
        $response->data = '';
        if (in_array($params->version, $this->versions)){
            //检测服务
            $servicePathName = '\\App\\Services\\'.$params->version.'\\'.$params->serviceName;
            if (class_exists($servicePathName)) {
                $service = new $servicePathName();
                $method = $params->methodName;
                if (method_exists($service,$method)){
                    $res = $service->$method();
                    $response->code = 200;
                    $response->data = json_encode($res);
                }else{
                    $response->code = 204;
                    $response->msg = '方法不存在';
                }
            }else{
                $response->code = 203;
                $response->msg = '服务不存在';
            }
        }else{
            $response->code = 202;
            $response->msg = '版本不存在';
        }
        return $response;
    }
}