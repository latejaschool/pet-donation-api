<?php

declare(strict_types=1);

namespace App\Controller\Api\Breed;

use App\Entity\Breed;
use App\Service\BreedService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditBreedController
{
    private breedService $service;

    public function __construct(breedService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $request = json_decode($request->getContent());

        $breed = $this->service->find($id);
        $this->service->update($breed, $request);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}