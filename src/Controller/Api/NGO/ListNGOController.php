<?php

declare(strict_types=1);

namespace App\Controller\Api\NGO;

use App\Entity\NGO;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListNGOController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(NGO::class);
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        if (null !== $id) {
            $ngo = $this->repository->find($id);

            return $this->json($ngo);
        }

        $response = $this->repository->findAll();

        return $this->json($response);
    }
}
