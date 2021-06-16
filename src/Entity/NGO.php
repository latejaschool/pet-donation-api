<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity()
 */
class NGO
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private Uuid $id;

    /**
     * @ORM\Column(length=100)
     */
    private string $name;

    /**
     * @ORM\Column(length=100, nullable=true)
     */
    private string $socialName;

    /**
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    private Address $address;

    /**
     * @ORM\Column(length=20, nullable=true)
     */
    private string $fiscalCode;

    /**
     * @ORM\Column(nullable=true)
     */
    private string $site;

    /**
     * @ORM\Column(length="11")
     */
    private string $phone;

    /**
     * @ORM\Column(type="datetime")
     */
    private \Datetime $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private \Datetime $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \Datetime $deletedAt;


    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSocialName(): string
    {
        return $this->socialName;
    }

    public function setSocialName(string $socialName): void
    {
        $this->socialName = $socialName;

    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getFiscalCode(): string
    {
        return $this->fiscalCode;
    }

    public function setFiscalCode(string $fiscalCode): void
    {
        $this->fiscalCode = $fiscalCode;
    }

    public function getSite(): string
    {
        return $this->site;
    }

    public function setSite(string $site): void
    {
        $this->site = $site;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeletedAt(): \DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}

