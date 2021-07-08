<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\PetType;
use App\Exception\InvalidPetTypeRequestException;
use App\Service\PetTypeService;
use App\Validator\PetTypeValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class AdminPetTypeController extends AbstractController
{
    private PetTypeService $service;
    private PetTypeValidator $validator;
    private SerializerInterface $serializer;

    public function __construct(PetTypeService $service, PetTypeValidator $validator, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    public function indexAction(): Response
    {
        return $this->render('pettype/index.html.twig', [
            'pettypes' => $this->service->findAll(),
        ]);
    }

    public function addAction(Request $request): Response
    {
        if (!$request->getContent()) {
            return $this->render('pettype/add.html.twig');
        }

        try {
            $this->validator->validateRequest($request);

            $pettype = $this->serializer->deserialize(
                json_encode($request->request->all()),
                PetType::class,
                'json'
            );

            $this->service->insert($pettype);

            $this->addFlash('success', 'O novo tipo de pet foi criado.');
        } catch (InvalidPetTypeRequestException $exception) {
            $this->addFlash('error', $exception->getMessage());

            return $this->redirectToRoute('admin_pettype_add');
        }

        return $this->redirectToRoute('admin_pettype_index');
    }
}