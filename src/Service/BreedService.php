<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Breed;
use App\Exception\BreedNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\Request;

class BreedService
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Breed::class);
    }

    public function insert(Breed $breed): Breed
    {
        $this->entityManager->persist($breed);
        $this->entityManager->flush();

        return $breed;
    }

    public function find(string $id): Breed
    {
        $breed = $this->repository->find($id);

        if (!$breed) {
            throw new \Exception("Breed not found");
        }

        return $breed;
    }
    
    public function findAll(): iterable
    {
        return $this->repository->findBy([
            "deletedAt" => null
        ]);
    }

    public function update(Request $request, Breed $breed): void
    {
        $breed->setName($request->get('name'));
        $breed->setDescription($request->get('description'));

        $this->entityManager->persist($breed);
        $this->entityManager->flush();
    }

    public function remove(string $id): void
    {
        $breed = $this->repository->find($id);

        if (!$breed) {
            throw new BreedNotFoundException();
        }

        $breed->setDeletedAt(new \DateTime());

        $this->entityManager->persist($breed);
        $this->entityManager->flush();
    }
}
