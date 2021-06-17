<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Pet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class PetFixtures extends Fixture implements DependentFixtureInterface
{
    public const PET_QUANTITY = 10;

    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i <= self::PET_QUANTITY; $i++) {
            $pet = new Pet();
            $pet->setName("Pet {$i}");
            $pet->setBirth(new \DateTime());
            $pet->setBreed($this->getReference("breed-1"));
            $pet->setPhotos([
                "0" => "https://www.themaineedge.com/media/k2/items/cache/1c72550d6134a289e35a027015d7e8b0_XL.jpg",
                "1" => "https://freepngimg.com/download/yoga/72125-doga-chihuahua-yoga-poodle-dogs-free-png-hq.png",
                "2" => "https://qph.fs.quoracdn.net/main-qimg-8695a74a1cde13ad7f62d05ee246e83b.webp"
            ]);
            $pet->setDescription("Description");
            $pet->setAvailable(true);
            $pet->setDiseases('');
            $pet->setVaccines('');
            $pet->setCreatedAt(new \DateTime());
            $pet->setId(Uuid::v4());
            $manager->persist($pet);
        }

        for ($i = 1; $i <= self::PET_QUANTITY; $i++) {
            $pet = new Pet();
            $pet->setName("Pet {$i}");
            $pet->setBirth(new \DateTime());
            $pet->setBreed($this->getReference("breed-2"));
            $pet->setPhotos([
                "0" => "https://www.themaineedge.com/media/k2/items/cache/1c72550d6134a289e35a027015d7e8b0_XL.jpg",
                "1" => "https://freepngimg.com/download/yoga/72125-doga-chihuahua-yoga-poodle-dogs-free-png-hq.png",
                "2" => "https://qph.fs.quoracdn.net/main-qimg-8695a74a1cde13ad7f62d05ee246e83b.webp"
            ]);
            $pet->setDescription("Description");
            $pet->setAvailable(true);
            $pet->setDiseases('');
            $pet->setVaccines('');
            $pet->setCreatedAt(new \DateTime());
            $pet->setId(Uuid::v4());
            $manager->persist($pet);
        }

        for ($i = 1; $i <= self::PET_QUANTITY; $i++) {
            $pet = new Pet();
            $pet->setName("Pet {$i}");
            $pet->setBirth(new \DateTime());
            $pet->setBreed($this->getReference("breed-3"));
            $pet->setPhotos([
                "0" => "https://www.themaineedge.com/media/k2/items/cache/1c72550d6134a289e35a027015d7e8b0_XL.jpg",
                "1" => "https://freepngimg.com/download/yoga/72125-doga-chihuahua-yoga-poodle-dogs-free-png-hq.png",
                "2" => "https://qph.fs.quoracdn.net/main-qimg-8695a74a1cde13ad7f62d05ee246e83b.webp"
            ]);
            $pet->setDescription("Description");
            $pet->setAvailable(true);
            $pet->setDiseases('');
            $pet->setVaccines('');
            $pet->setCreatedAt(new \DateTime());
            $pet->setId(Uuid::v4());
            $manager->persist($pet);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BreedFixtures::class,
        ];
    }
}
