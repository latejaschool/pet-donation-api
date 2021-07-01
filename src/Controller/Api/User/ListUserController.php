<?php

declare(strict_types=1);

namespace App\Controller\Api\User;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListUserController extends AbstractController
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        if (null !== $id) {
            $user = $this->service->find($id);
            return $this->json($user);
        }

        $response = $this->service->findAll();
        return $this->json($response);
    }
}
