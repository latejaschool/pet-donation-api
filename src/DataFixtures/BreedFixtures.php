<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class BreedFixtures extends Fixture
{
    public const BREED_QUANTITY = 50;

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::BREED_QUANTITY; $i++) {
            $breed = new Breed();
            $breed->setName("Raça Teste {$i}");
            $breed->setDescription("Descrição da Raça {$i}");
            $breed->setId(Uuid::v4());

            $manager->persist($breed);
        }

        $manager->flush();
    }
}
