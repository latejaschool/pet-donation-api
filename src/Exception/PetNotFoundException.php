<?php

declare(strict_types=1);

namespace App\Exception;

use Throwable;

class PetNotFoundException extends \Exception
{
    public function __construct(string $message = 'Pet not found', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}