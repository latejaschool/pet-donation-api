<?php

declare(strict_types=1);

namespace App\Service;


use App\Entity\PetType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class PetTypeService
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(PetType::class);
    }

    public function insert(PetType $petType): PetType
    {
        return $petType;
    }

    public function find(string $id): PetType
    {

    }

    public function findAll(): iterable
    {

    }

    public function update(string $id, PetType $petType): void
    {

    }

    public function remove(string $id): void
    {

    }

}
