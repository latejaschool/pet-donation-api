<?php

declare(strict_types=1);

namespace App\Controller\Api\User;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserController extends AbstractController
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function __invoke(string $id): JsonResponse
    {

        $this->service->remove($id);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

}

