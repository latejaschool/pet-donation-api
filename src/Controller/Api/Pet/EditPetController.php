<?php

declare(strict_types=1);

namespace App\Controller\Api\Pet;

use App\Entity\Pet;
use App\Entity\Breed;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditPetController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Pet::class);
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $request = json_decode($request->getContent());

        $pet = $this->repository->find($id);
        $pet->setName($request->name ?? $pet->getName());

        $birth = isset($request->birth) ? \DateTime::createFromFormat('Y-m-d', $request->birth) : $pet->getBirth();
        $pet->setBirth($birth);

        $breed = isset($request->breed) ? $this->entityManager->getRepository(Breed::class)->find($request->breed) : $pet->getBreed();
        $pet->setBreed($breed);

        $pet->setPhotos($request->photos ?? $pet->getPhotos());

        $pet->setDescription($request->description ?? $pet->getDescription());
        $pet->setAvailable($request->available ?? $pet->isAvailable());
        $pet->setDiseases($request->diseases ?? $pet->getDiseases());
        $pet->setVaccines($request->vaccines ?? $pet->getVaccines());

        $pet->setUpdatedAt(new \DateTime());

        $this->entityManager->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
