<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Pet;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class PetService
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Pet::class);
    }

    public function insert(Pet $pet): Pet
    {
        return $pet;
    }

    public function find(string $id): Pet
    {
        
    }
    
    public function findAll(): iterable
    {
        
    }

    public function update(string $id, Pet $pet): void
    {
        
    }

    public function remove(string $id): void
    {
        $pet = $this->repository->find($id);

        if (!$pet) {
            throw new \Exception("Pet not found");
        }

        $pet->setDeletedAt(new \DateTime());

        $this->entityManager->flush();
    }
}