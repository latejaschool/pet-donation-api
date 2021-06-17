<?php

declare(strict_types=1);

namespace App\Controller\Api\Breed;

use App\Entity\Breed;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListBreedController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Breed::class);
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        if (null !== $id) {
            $breed = $this->repository->find($id);

            return $this->json($breed);
        }

        $response = $this->repository->findAll();

        return $this->json($response);
    }
}
