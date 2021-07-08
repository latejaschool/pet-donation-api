<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

/**
 * @ORM\Entity()
 */
class Pet
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private Uuid $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private string $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTime $birth;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Breed")
     * @ORM\JoinColumn(name="breed_id", referencedColumnName="id")
     */
    private Breed $breed;

    /**
     * @ORM\Column(type="array")
     */
    private array $photos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $available;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $diseases;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $vaccines;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \DateTime $deletedAt;

    public function __construct()
    {
        $this->id = new UuidV4();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->available = true;
    }

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

    public function getBirth(): \DateTime
    {
        return $this->birth;
    }

    public function setBirth(\DateTime $birth): void
    {
        $this->birth = $birth;
    }

    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(Breed $breed): void
    {
        $this->breed = $breed;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }

    public function getDiseases(): string
    {
        return $this->diseases;
    }

    public function setDiseases(string $diseases): void
    {
        $this->diseases = $diseases;
    }

    public function getVaccines(): string
    {
        return $this->vaccines;
    }

    public function setVaccines(string $vaccines): void
    {
        $this->vaccines = $vaccines;
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
