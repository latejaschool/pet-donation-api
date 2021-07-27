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
    public const PETTYPE_QUANTITY_TOTAL = 23;

    public const PETTYPE_CAT_ID = '5ac62fa8-7175-43cf-bf47-0889a1ce45ec';

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::PETTYPE_QUANTITY; $i++) {
            $pettype = new PetType();
            $pettype->setName("Tipo {$i}");
            $pettype->setId(Uuid::v4());
            $pettype->setCreatedAt(new \DateTime());
            $pettype->setUpdatedAt(new \DateTime());

            $manager->persist($pettype);
        }

        $cat = new PetType();
        $cat->setName("Gato");
        $cat->setId(new Uuid(self::PETTYPE_CAT_ID));
        $cat->setCreatedAt(new \DateTime());
        $cat->setUpdatedAt(new \DateTime());

        $manager->persist($cat);

        $dog = new PetType();
        $dog->setName("Cachorro");
        $dog->setId(Uuid::v4());
        $dog->setCreatedAt(new \DateTime());
        $dog->setUpdatedAt(new \DateTime());

        $manager->persist($dog);

        $bird = new PetType();
        $bird->setName("Pássaro");
        $bird->setId(Uuid::v4());
        $bird->setCreatedAt(new \DateTime());
        $bird->setUpdatedAt(new \DateTime());

        $manager->persist($bird);

        $manager->flush();
    }

}
