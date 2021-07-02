<?php

declare(strict_types=1);

namespace App\Controller\Api\NGO;

use App\Service\NGOService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditNGOController extends AbstractController
{
    private NGOService $service;

    public function __construct(NGOService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $request = json_decode($request->getContent());

        $ngo = $this->service->find($id);
        $this->service->update($ngo, $request);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
