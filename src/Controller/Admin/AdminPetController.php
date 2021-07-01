<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Service\PetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminPetController extends AbstractController
{
    private PetService $service;

    public function __construct(PetService $service)
    {
        $this->service = $service;
    }

    public function indexAction(): Response
    {
        return $this->render('pet/index.html.twig', [
            'pets' => $this->service->findAll(),
        ]);
    }

}
