<?php
namespace App\Library\Rpc;

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Protocol\TMultiplexedProtocol;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TSocket;
use App\Library\Thrift\ThriftCommonCallServiceClient;
use App\Helpers\HttpResponse;
use phpDocumentor\Reflection\Types\This;

class Client
{
    // 保存对象实例化
    private $_instance;
    
    // 保存服务连接池
    private static $client = [];
    
    // 配置文件
    private $config = [];
    
    private function __construct($type)
    {
        $config = [
            'rpc' => [
                'host' => config('base.rpc.host'),
                'port' => config('base.rpc.port'),
                'pass' => config('base.rpc.pass'),
            ]
        ];
        $this->config = $config[$type];
    }
    
    /**
     * 连接服务
     * @param string $name  调用的方法名
     * @param array $args   1、请求版本   2、所属的 Service名称  3、具体哪个方法名   4、参数数组 
     * @return bool
     */
    public static function __callStatic($name, $args)
    {
        if (substr($name, 0, 8) != 'SocketTo') {
            return false;
        }
        
        $type = strtolower(substr($name, 8));
        // 实例化操作
        if (!isset(self::$client[$type])) {
            self::$client[$type] = new self($type);
        }
        
        return self::$client[$type]->invoke($args);
    }
    
    private function invoke($args)
    {
        try {
            $socket = new TSocket($this->config['host'], $this->config['port']);
            $socket->setRecvTimeout(50000);
            $socket->setDebug(true);
            $transport = new TBufferedTransport($socket, 1024, 1024);
            $protocol = new TBinaryProtocol($transport);
            $thriftProtocol = new TMultiplexedProtocol($protocol, 'thriftCommonCallService');
            $client = new ThriftCommonCallServiceClient($thriftProtocol);
            $transport->open();
            // 拼装参数与类型
            $data = [
                'pass'        => $this->config['pass'],
                'version'     => $args[0],
                'serviceName' => $args[1],
                'methodName'  => $args[2],
                'params'      => $args[3]
            ];
            $result = $client->invokeMethod(json_encode($data));
            $result->data = json_decode($result->data, true);
            $transport->close();
            return $result;
        } catch (\TException $Te) {
            app('log')->error('服务连接失败 ', ['host' => $this->config, 'parms' => $args, 'content' => $Te->getMessage()]);
            return ['code' => HttpResponse::RPC_CONNECT_FAIL, 'msg' => 'error', 'data' => $Te->getMessage()];
        }
    }
}