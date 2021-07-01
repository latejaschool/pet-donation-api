<?php

declare(strict_types=1);

namespace App\Controller\Api\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditUserController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $request = json_decode($request->getContent());

        $user = $this->repository->find($id);
        $user->setName($request->name ?? $user->getName());
        $user->setEmail($request->email ?? $user->getEmail());
        $user->setPhone($request->phone ?? $user->getPhone());
        $user->setStatus($request->status ?? $user->getStatus());
        $user->setPhoto($request->photo ?? $user->getPhoto());

        if (isset($request->password)) {
            $hash = password_hash($request->password, PASSWORD_ARGON2I);
            $user->setPassword($hash);
        }

        $user->setUpdatedAt(new \DateTime());

        $this->entityManager->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

}
