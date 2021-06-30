<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

class ThirdPartyRequestException extends Exception
{
    public function __construct(string $message = "", int $code = FoundationResponse::HTTP_BAD_REQUEST)
    {
        parent::__construct($message, $code);
    }
}
