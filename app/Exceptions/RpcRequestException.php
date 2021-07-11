<?php
namespace App\Exceptions;

use Exception;
use App\Helpers\HttpResponse;

class RpcRequestException extends Exception
{
    public function __construct(string $message = "", int $code = HttpResponse::HTTP_OK)
    {
        parent::__construct($message, $code);
    }
    
    /**
     * 报告异常
     *
     * @return void
     */
    public function report()
    {
        //
    }
    
    /**
     * 渲染异常为 HTTP 响应
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        //
    }
}
