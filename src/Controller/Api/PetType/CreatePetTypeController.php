<?php

declare(strict_types=1);

namespace App\Controller\Api\PetType;

use App\Entity\PetType;
use App\Service\PetTypeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class CreatePetTypeController extends AbstractController
{
    private PetTypeService $service;
    private SerializerInterface $serializer;

    public function __construct(PetTypeService $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;           
    }

    public function __invoke(Request $request): JsonResponse
    {
        $petType = $this->serializer->deserialize(
            $request->getContent(),
            PetType::class,
            'json'
        );

        $this->service->insert($petType);

        return $this->json($petType, Response::HTTP_CREATED);
    }

}

