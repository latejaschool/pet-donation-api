<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\NGO;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class NGOService
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(NGO::class);
    }

    public function insert(NGO $ngo): NGO
    {
        $this->entityManager->persist($ngo);
        $this->entityManager->flush();

        return $ngo;
    }

    public function find(string $id): NGO
    {

    }

    public function findAll(): iterable
    {

    }

    public function update(string $id, NGO $ngo): void
    {

    }

    public function remove(string $id): void
    {
        $ngo = $this->repository->find($id);

        if (!$ngo) {
            throw new \Exception("NGO not found");
        }

        $ngo->setDeletedAt(new \DateTime());

        $this->entityManager->flush();
    }
}