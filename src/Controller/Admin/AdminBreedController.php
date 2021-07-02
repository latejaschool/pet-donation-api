<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Breed;
use App\Service\BreedService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class AdminBreedController extends AbstractController
{
    private BreedService $service;
    private SerializerInterface $serializer;

    public function __construct(BreedService $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    public function indexAction(): Response
    {
        return $this->render('breed/index.html.twig', [
            'breeds' => $this->service->findAll(),
        ]);
    }

    public function addAction(Request $request): Response
    {
        if (!$request->getContent()) {
            return $this->render('breed/add.html.twig');
        }

        $breed = $this->serializer->deserialize(
            json_encode($request->request->all()),
            Breed::class,
            'json'
        );

        $this->service->insert($breed);

        return $this->redirectToRoute('admin_breed_index');
    }

    public function removeAction(string $id): Response
    {
        $this->service->remove($id);

        return $this->redirectToRoute('admin_breed_index');
    }
}