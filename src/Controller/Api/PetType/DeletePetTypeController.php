<?php

declare(strict_types=1);

namespace App\Controller\Api\PetType;

use App\Entity\PetType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeletePetTypeController extends AbstractController
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
        $petType = $this->repository->find($id);

        if (!$petType) {
            throw new \Exception("Pet Type not found");
        }

        $petType->setDeletedAt(new \DateTime());

        $this->entityManager->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}