<?php

declare(strict_types=1);

namespace App\Exception;

use Throwable;

class BreedNotFoundException extends \Exception
{
    public function __construct(string $message = 'Breed not found', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}