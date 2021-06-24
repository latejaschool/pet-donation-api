<?php

declare(strict_types=1);

namespace App\Controller\Api\NGO;

use App\Entity\NGO;
use App\Service\NGOService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CreateNGOController extends AbstractController
{
    private NGOService $service;
    private SerializerInterface $serializer;

    public function __construct(NGOService $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $ngo = $this->serializer->deserialize(
            $request->getContent(),
            NGO::class,
            'json'
        );

        $this->service->insert($ngo);

        return $this->json($ngo, Response::HTTP_CREATED);
    }
}
