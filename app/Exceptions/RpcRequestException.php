<?php
namespace App\Exceptions;

use Exception;
use App\Helpers\HttpRespons;

class RpcRequestException extends Exception
{
    public function __construct(string $message = "", int $code = HttpRespons::HTTP_BAD_REQUEST)
    {
        parent::__construct($message, $code);
    }
}
