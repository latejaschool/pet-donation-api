<?php

declare(strict_types=1);

namespace App\Controller\Api\PetType;

use App\Service\PetTypeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeletePetTypeController extends AbstractController
{
    private PetTypeService $service;

    public function __construct(PetTypeService $service)
    {
        $this->service = $service;
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        $this->service->remove($id);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}