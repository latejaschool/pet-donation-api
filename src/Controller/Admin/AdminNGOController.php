<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Service\NGOService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminNGOController extends AbstractController
{
    private NGOService $service;

    public function __construct(NGOService $service)
    {
        $this->service = $service;
    }

    public function indexAction(): Response
    {
        return $this->render('ngo/index.html.twig', [
            'ngos' => $this->service->findAll(),
        ]);
    }
}