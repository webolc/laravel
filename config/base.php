<?php
return [
    'domain' =>env('APP_DOMAIN','') ,
    'rpc'    => [
        'host' => env('ERP_RPC_HOST','127.0.0.1'),
        'port' => env('ERP_RPC_PORT',9999),
        'pass' => md5('laravel')
    ]
];