<?php

declare(strict_types=1);

namespace App\Controller\Api\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListUserController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        if (null !== $id) {
            $user = $this->repository->find($id);

            return $this->json($user);
        }

        $response = $this->repository->findAll();

        return $this->json($response);
    }
}
