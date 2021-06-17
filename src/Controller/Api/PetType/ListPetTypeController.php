<?php

declare(strict_types=1);

namespace App\Controller\Api\PetType;


use App\Entity\PetType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListPetTypeController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(PetType::class);
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        if (null !== $id) {
            $petType = $this->repository->find($id);

            return $this->json($petType);
        }

        $response = $this->repository->findAll();

        return $this->json($response);
    }
}