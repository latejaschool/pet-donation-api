<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\InvalidUserRequestException;
use Symfony\Component\HttpFoundation\Request;

class UserValidator
{
    public function validateRequest(Request $request): void
    {
        $request = $request->request->all();

        if (!isset($request['name']) || strlen($request['name']) < 4) {
            throw new InvalidUserRequestException('Nome precisa ter no minimo 4 digitos');
        }

        if (!isset($request['email']) || strlen($request['email']) < 5) {
            throw new InvalidUserRequestException('Necessário um e-mail válido');
        }
    }
}