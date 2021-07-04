<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Exception\PetNotFoundException;
use App\Service\PetService;
use Doctrine\DBAL\Types\ConversionException;
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

    public function removeAction(string $id): Response
    {
        try {
            $this->service->remove($id);
            $this->addFlash('success', 'O pet foi removio.');
        } catch (ConversionException $exception) {
            $this->addFlash('error', 'O id do pet que você tentou excluir está inválido.');
        } catch (PetNotFoundException $exception) {
            $this->addFlash('error', 'Pet não encontrado.');
        } catch (\Exception $exception) {
            $this->addFlash('error', 'Algum erro aconteceu. Tente novamente');
        }

        return $this->redirectToRoute('admin_pet_index');
    }
}
