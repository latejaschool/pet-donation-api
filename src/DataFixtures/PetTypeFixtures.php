<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\PetType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class PetTypeFixtures extends Fixture
{
    public const PETTYPE_QUANTITY = 20;

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::PETTYPE_QUANTITY; $i++) {
            $pettype = new PetType();
            $pettype->setName("Tipo {$i}");
            $pettype->setId(Uuid::v4());

            $manager->persist($pettype);
        }

        $cat = new PetType();
        $cat->setName("Gato");
        $cat->setId(Uuid::v4());

        $manager->persist($cat);

        $dog = new PetType();
        $dog->setName("Cachorro");
        $dog->setId(Uuid::v4());

        $manager->persist($dog);

        $bird = new PetType();
        $bird->setName("Pássaro");
        $bird->setId(Uuid::v4());

        $manager->persist($bird);

        $manager->flush();
    }

}
