<?php

declare(strict_types=1);

namespace App\Exception;

use Throwable;

class InvalidBreedRequestException extends \Exception
{
    public function __construct(string $message = 'Invalid request for create a breed', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}