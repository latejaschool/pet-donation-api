<?php

declare(strict_types=1);

namespace App\Controller\Api\Breed;

use App\Service\BreedService;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteBreedController extends AbstractController
{
    private BreedService $service;

    public function __construct(BreedService $service)
    {
        $this->service = $service;
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        $this->service->remove($id);

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
