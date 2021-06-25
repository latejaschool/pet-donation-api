<?php

declare(strict_types=1);

namespace App\Controller\Api\NGO;

use App\Service\NGOService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteNGOController extends AbstractController
{
    private NGOService $service;

    public function __construct(NGOService $service)
    {
        $this->service = $service;
    }

    public function __invoke(?string $id = null): JsonResponse
    {
        $this->service->remove($id);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
