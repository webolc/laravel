<?php
namespace App\Exceptions;

use Exception;
use App\Helpers\HttpResponse;

class RpcRequestException extends Exception
{
    public function __construct(string $message = "", int $code = HttpResponse::HTTP_BAD_REQUEST)
    {
        parent::__construct($message, $code);
    }
}
