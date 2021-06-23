<?php

declare(strict_types=1);

namespace App\Controller\Api\NGO;

use App\Entity\NGO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CreateNGOController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $ngo = $this->serializer->deserialize(
            $request->getContent(),
            NGO::class,
            'json'
        );

        $this->entityManager->persist($ngo);
        $this->entityManager->flush();

        return $this->json($ngo, Response::HTTP_CREATED);
    }
}
