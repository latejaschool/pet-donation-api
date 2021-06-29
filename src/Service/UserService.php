<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class UserService
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }

    public function insert(User $user): User
    {
        $hash = password_hash($user->getPassword(), PASSWORD_ARGON2I);
        $user->setPassword($hash);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function find(string $id): User
    {
        
    }
    
    public function findAll(): iterable
    {
        
    }

    public function update(string $id, User $user): void
    {
        
    }

    public function remove(string $id): void
    {
        $user = $this->repository->find($id);

        if (!$user) {
            throw new \Exception("User not found");
        }

        $user->setDeletedAt(new \DateTime());

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

}
