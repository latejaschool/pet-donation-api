<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Breed;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

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

    }

    public function findAll(): iterable
    {

    }

    public function update(string $id, Breed $breed): void
    {

    }

    public function remove(string $id): void
    {
        $breed = $this->repository->find($id);

        if (!$breed) {
            throw new \Exception("Breed not found");
        }

        $breed->setDeletedAt(new \DateTime());

        $this->entityManager->persist($breed);
        $this->entityManager->flush();
    }
}
