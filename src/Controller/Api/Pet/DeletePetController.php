<?php

declare(strict_types=1);

namespace App\Controller\Api\Pet;

use App\Entity\Pet;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeletePetController extends AbstractController
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
        $pet = $this->repository->find($id);

        if (!$pet) {
            throw new \Exception("Pet not found");
        }

        $pet->setDeletedAt(new \DateTime());

        $this->entityManager->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
