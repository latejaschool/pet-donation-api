<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Service\BreedService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminBreedController extends AbstractController
{
    private BreedService $service;

    public function __construct(BreedService $service)
    {
        $this->service = $service;
    }

    public function indexAction(): Response
    {
        return $this->render('breed/index.html.twig', [
            'breeds' => $this->service->findAll(),
        ]);
    }
}