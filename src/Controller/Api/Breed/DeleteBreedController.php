<?php

declare(strict_types=1);

namespace App\Controller\Api\Breed;

use App\Entity\Breed;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteBreedController extends AbstractController
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
        $breed = $this->repository->find($id);

        if (!$breed) {
            throw new \Exception("Breed not found");
        }

        $breed->setDeletedAt(new \DateTime());

        $this->entityManager->persist($breed);
        $this->entityManager->flush();

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
