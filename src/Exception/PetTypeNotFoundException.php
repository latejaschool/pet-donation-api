<?php

declare(strict_types=1);

namespace App\Exception;

use Throwable;

class PetTypeNotFoundException extends \Exception
{
    public function __construct(string $message = 'Pet type not found', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}