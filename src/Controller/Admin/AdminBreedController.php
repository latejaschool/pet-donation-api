<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Breed;
use App\Exception\BreedNotFoundException;
use App\Exception\InvalidBreedRequestException;
use App\Service\BreedService;
use App\Validator\BreedValidator;
use Doctrine\DBAL\Types\ConversionException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class AdminBreedController extends AbstractController
{
    private BreedService $service;
    private BreedValidator $validator;
    private SerializerInterface $serializer;

    public function __construct(BreedService $service, BreedValidator $validator, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->validator = $validator;
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

        try {
            $this->validator->validateRequest($request);

            $breed = $this->serializer->deserialize(
                json_encode($request->request->all()),
                Breed::class,
                'json'
            );

            $this->service->insert($breed);

            $this->addFlash('success', 'A nova raça foi criada.');
        } catch (InvalidBreedRequestException $exception) {
            $this->addFlash('error', $exception->getMessage());

            return $this->redirectToRoute('admin_breed_add');
        }

        return $this->redirectToRoute('admin_breed_index');
    }

    public function removeAction(string $id): Response
    {
        try {
            $this->service->remove($id);
            $this->addFlash('success', 'A raça foi removida.');
        } catch (ConversionException $exception) {
            $this->addFlash('error', 'O id da raça que você tentou excluir está inválido.');
        } catch (BreedNotFoundException $exception) {
            $this->addFlash('error', 'breed_not_found');
        } catch (\Exception $exception) {
            $this->addFlash('error', 'Algum erro aconteceu. Tente novamente');
        }

        return $this->redirectToRoute('admin_breed_index');
    }
}