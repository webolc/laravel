<?php 
namespace App\Library\Rpc;

use App\Library\Thrift\ThriftCommonCallServiceIf;
use App\Library\Thrift\Response;
use App\Helpers\HttpResponse;
use App\Exceptions\RpcRequestException;

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
        $response = new Response();
        try{
            // 转换字符串 json
            $params = json_decode($params);
            
            if ($params->pass != config('base.rpc.pass')){
                throw new RpcRequestException('非法访问',HttpResponse::RPC_NOACCESS);
            }
            if (!in_array($params->version, $this->versions)){
                throw new RpcRequestException('版本不存在',HttpResponse::RPC_VERSION_NOTEXIST);
            }
            //检测服务
            $servicePathName = '\\App\\Services\\'.$params->version.'\\'.$params->serviceName;
            if (!class_exists($servicePathName)) {
                throw new RpcRequestException('服务不存在',HttpResponse::RPC_SERVICE_NOTEXIST);
            }
            $service = new $servicePathName($params->params);
            $method = $params->methodName;
            if (!method_exists($service,$method)){
                throw new RpcRequestException('方法不存在',HttpResponse::RPC_METHOD_NOTEXIST);
            }
            $res = $service->$method();
            $response->msg = 'success';
            $response->code = HttpResponse::HTTP_OK;
            $response->data = json_encode($res);
            
        }catch (RpcRequestException $e){
            $response->data = json_encode(errBack($e->getMessage()));
            $response->code = $e->getCode();
            $response->msg = 'error';
        }
        return $response;
    }
}