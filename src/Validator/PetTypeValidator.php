<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\InvalidPetTypeRequestException;
use Symfony\Component\HttpFoundation\Request;

class PetTypeValidator
{
    public function validateRequest(Request $request): void
    {
        $request = $request->request->all();

        if (!isset($request['name']) || strlen($request['name']) < 3) {
            throw new InvalidPetTypeRequestException('Nome precisa ter no minimo 3 digitos');
        }
    }
}