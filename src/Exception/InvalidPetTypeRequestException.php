<?php

declare(strict_types=1);

namespace App\Exception;

use Throwable;

class InvalidPetTypeRequestException extends \Exception
{
    public function __construct(string $message = 'Invalid request for create a pet type', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}