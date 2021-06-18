<?php

declare(strict_types=1);

namespace App\Controller\Api\Breed;

use App\Entity\Pet;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListPetByBreedControlller extends AbstractController
{
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Pet::class);
    }

    public function __invoke(string $id): JsonResponse
    {
        $pets = $this->repository->findBy([
            'breed' => $id,
        ]);

        return $this->json($pets);
    }

}