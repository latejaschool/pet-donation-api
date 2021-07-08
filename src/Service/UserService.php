<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\Request;


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
        $user = $this->repository->find($id);

        if (!$user) {
            throw new \Exception("User not found");
        }

        return $user;
    }
    
    public function findAll(): iterable
    {
        return $this->repository->findBy([
            "deletedAt" => null
        ]);
    }

    public function update(Request $request, User $user): void
    {
        $user->setName($request->get('name'));
        $user->setEmail($request->get('email'));
        $user->setPassword($request->get(password_hash('password',PASSWORD_ARGON2I)));
        $user->setPhone($request->get('phone'));
        $user->setPhoto($request->get('photo'));

        $this->entityManager->persist($user);
        $this->entityManager->flush();
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
