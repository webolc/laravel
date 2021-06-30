<?php
namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;

class HttpRespons extends Response{
    
    public const RPC_CONNECT_FAIL = 10001;
    
    public $rpcStatusTexts = [
        1001 => 'rpc connect fail',
        
    ];
    public static $statusTexts = array_merge(parent::$statusTexts,$this->rpcStatusTexts);
}