<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\InvalidBreedRequestException;
use Symfony\Component\HttpFoundation\Request;

class BreedValidator
{
    public function validateRequest(Request $request): void
    {
        $request = $request->request->all();

        if (!isset($request['name']) || strlen($request['name']) < 3) {
            throw new InvalidBreedRequestException('Nome precisa ter no minimo 3 digitos');
        }

        if (!isset($request['description']) || strlen($request['description']) < 10) {
            throw new InvalidBreedRequestException('Descricão precisa ter no minimo 10 digitos');
        }
    }
}