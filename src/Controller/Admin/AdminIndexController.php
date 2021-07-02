<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminIndexController extends AbstractController
{
    public function indexAction(): Response
    {
        return $this->render('index/dashboard.html.twig');
    }
}