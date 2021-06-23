<?php

declare(strict_types=1);

namespace App\Controller\Api\Breed;

use App\Entity\Breed;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditBreedController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Breed::class);
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $request = json_decode($request->getContent());

        $breed = $this->repository->find($id);
        $breed->setName($request->name ?? $breed->getName());
        $breed->setDescription($request->description ?? $breed->getDescription());

        $breed->setUpdatedAt(new \DateTime());

        $this->entityManager->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}