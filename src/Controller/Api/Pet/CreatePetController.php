<?php

declare(strict_types=1);

namespace App\Controller\Api\Pet;

use App\Entity\Pet;
use App\Service\BreedService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CreatePetController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;
    private BreedService $breedService;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer, BreedService $breedService)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->breedService = $breedService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $pet = $this->serializer->deserialize(
            $request->getContent(),
            Pet::class,
            'json'
        );

        $request = json_decode($request->getContent());

        $pet->setBreed(
            $this->breedService->find(
                $request->breed
            )
        );

        $this->entityManager->persist($pet);
        $this->entityManager->flush();

        return $this->json($pet, Response::HTTP_CREATED);
    }
}