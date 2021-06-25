<?php

declare(strict_types=1);

namespace App\Controller\Api\Breed;

use App\Service\BreedService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListBreedController extends AbstractController
{
    private BreedService $service;

    public function __construct(BreedService $service)
    {
        $this->service = $service;
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        if (null !== $id) {
            $breed = $this->service->find($id);
            return $this->json($breed);
        }

        $response = $this->service->findAll($id);
        return $this->json($response);
    }
}
