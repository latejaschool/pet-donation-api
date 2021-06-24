<?php

declare(strict_types=1);

namespace App\Controller\Api\User;

use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CreateUserController extends AbstractController
{
    private UserService $service;
    private SerializerInterface $serializer;

    public function __construct(UserService $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $user = $this->serializer->deserialize(
            $request->getContent(),
            User::class,
            'json'
        );
        $hash = password_hash($user->getPassword(), PASSWORD_ARGON2I);
        $user->setPassword($hash);

        $this->service->insert($user);

        return $this->json($user, Response::HTTP_CREATED);
    }
}