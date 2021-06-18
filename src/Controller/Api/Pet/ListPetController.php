<?php

declare(strict_types=1);

namespace App\Controller\Api\Pet;

use App\Entity\Pet;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListPetController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Pet::class);
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        if (null !== $id) {
            $pet = $this->repository->find($id);

            return $this->json($pet);
        }

        $response = $this->repository->findAll();

        return $this->json($response);
    }
}
