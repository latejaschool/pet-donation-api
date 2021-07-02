<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Address;
use App\Entity\NGO;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use stdClass;
use Symfony\Component\HttpFoundation\Request;

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
        $ngo = $this->repository->find($id);

        return $ngo;
    }

    public function findAll(): iterable
    {
        $response = $this->repository->findBy([
            "deletedAt" => null
        ]);

        return $response;
    }

    public function update(NGO $ngo, stdClass $request): void
    {
        $ngo->setName($request->name ?? $ngo->getName());
        $ngo->setSocialName($request->socialName ?? $ngo->getName());

        $addressCurrent = $ngo->getAddress();
        if (isset($request->address)) {
            $address = new Address();
            $address->setStreet($request->address->street ?? $addressCurrent->getStreet());
            $address->setNumber($request->address->number ?? $addressCurrent->getNumber());
            $address->setDistrict($request->address->district ?? $addressCurrent->getDistrict());
            $address->setComplement($request->address->complement ?? $addressCurrent->getComplement());
            $address->setCity($request->address->city ?? $addressCurrent->getCity());
            $address->setState($request->address->state ?? $addressCurrent->getState());
            $address->setZipcode($request->address->zipcode ?? $addressCurrent->getZipcode());
        }
        $ngo->setAddress($address ?? $addressCurrent);

        $ngo->setFiscalCode($request->fiscalCode ?? $ngo->getFiscalCode());
        $ngo->setSite($request->site ?? $ngo->getSite());
        $ngo->setPhone($request->phone ?? $ngo->getPhone());

        $ngo->setUpdatedAt(new \DateTime());

        $this->entityManager->flush();
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
