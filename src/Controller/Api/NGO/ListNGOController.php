<?php

declare(strict_types=1);

namespace App\Controller\Api\NGO;

use App\Service\NGOService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListNGOController extends AbstractController
{
    private NGOService $service;

    public function __construct(NGOService $service)
    {
        $this->service = $service;
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        if (null !== $id) {
            $ngo = $this->service->find($id);
            return $this->json($ngo);
        }

        $response = $this->service->findAll();
        return $this->json($response);
    }
}
