<?php

declare(strict_types=1);

namespace App\Service;


use App\Entity\PetType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\Request;

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
        $this->entityManager->persist($petType);
        $this->entityManager->flush();

        return $petType;
    }

    public function find(string $id): PetType
    {
        $petType = $this->repository->find($id);

        if (!$petType) {
            throw new \Exception("PetType not found");
        }

        return $petType;
    }

    public function findAll(): iterable
    {
        return $this->repository->findBy([
            "deletedAt" => null
        ]);
    }

    public function update(PetType $petType, \stdClass $request): void
    {
        $petType->setName($request->name ?? $petType->getName());
        $this->entityManager->flush();
    }

    public function remove(string $id): void
    {
        $petType = $this->repository->find($id);

        if (!$petType) {
            throw new \Exception("PetType not found");
        }

        $petType->setDeletedAt(new \DateTime());

        $this->entityManager->flush();

    }

}

