<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Service\PetTypeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminPetTypeController extends AbstractController
{
    private PetTypeService $service;

    public function __construct(PetTypeService $service)
    {
        $this->service = $service;
    }

    public function indexAction(): Response
    {
        return $this->render('pettype/index.html.twig', [
            'pettypes' => $this->service->findAll(),
        ]);
    }
}