<?php

declare(strict_types=1);

namespace App\Controller\Api\PetType;

use App\Entity\PetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class CreatePetTypeController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;           
    }

    public function __invoke(Request $request): JsonResponse
    {
        $petType = $this->serializer->deserialize(
            $request->getContent(),
            PetType::class,
            'json'
        );

        $this->entityManager->persist($petType);
        $this->entityManager->flush();

        return $this->json($petType, Response::HTTP_CREATED);
    }
}
