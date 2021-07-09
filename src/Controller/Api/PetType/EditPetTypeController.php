<?php

declare(strict_types=1);

namespace App\Controller\Api\PetType;

use App\Service\PetTypeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditPetTypeController extends AbstractController
{
    private PetTypeService $service;
    public function __construct(PetTypeService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $request = json_decode($request->getContent());

        $petType = $this->service->find($id);
        $this->service->update($petType, $request);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

}

