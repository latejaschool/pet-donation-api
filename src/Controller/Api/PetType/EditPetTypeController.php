<?php

declare(strict_types=1);

namespace App\Controller\Api\PetType;

use App\Entity\PetType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditPetTypeController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(PetType::class);
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $request = json_decode($request->getContent());

        $petType = $this->repository->find($id);
        $petType->setName($request->name ?? $petType->getName());

        $this->entityManager->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

}

