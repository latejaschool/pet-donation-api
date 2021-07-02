<?php

declare(strict_types=1);

namespace App\Controller\Api\Breed;

use App\Entity\Breed;
use App\Service\BreedService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CreateBreedController extends AbstractController
{
    private BreedService $service;
    private SerializerInterface $serializer;

    public function __construct(BreedService $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $breed = $this->serializer->deserialize(
            $request->getContent(),
            Breed::class,
            'json'
        );

        $this->service->insert($breed);


        return $this->json($breed, Response::HTTP_CREATED);
    }
}