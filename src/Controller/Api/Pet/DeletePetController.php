<?php

declare(strict_types=1);

namespace App\Controller\Api\Pet;

use App\Entity\Pet;
use App\Service\PetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeletePetController extends AbstractController
{
    private PetService $service;

    public function __construct(PetService $service)
    {
        $this->service = $service;
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        $this->service->remove($id);
        
        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
