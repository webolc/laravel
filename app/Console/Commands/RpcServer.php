<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SocketService;

class RpcServer extends Command
{
    /**
     * 控制台命令 signature 的名称。
     *
     * @var string
     */
    protected $signature = 'server:rpc';
    
    /**
     * 控制台命令说明。
     *
     * @var string
     */
    protected $description = 'rpc 服务';
    
    protected static $socketController;
    
    /**
     * rpcServer constructor.
     * @param SocketController $socketController
     */
    public function __construct(SocketService $socketService)
    {
        parent::__construct();
        self::$socketController = $socketService;
    }
    
    /**
     * 执行控制台命令。
     *
     * @return mixed
     */
    public function handle()
    {
        self::$socketController->server();
    }
}