<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\NGO;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class NGOFixtures extends Fixture
{
    public const NGO_QUANTITY = 50;

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::NGO_QUANTITY; $i++) {
            $address = new Address;
            $address->setId(Uuid::v4());
            $address->setStreet("Rua teste {$i}");
            $address->setNumber($i);
            $address->setDistrict("Bairro {$i}");
            $address->setState("CE");
            $address->setZipcode("6016000");

            $ngo = new NGO();
            $ngo->setId(Uuid::v4());
            $ngo->setName("Nome da ONG {$i}");
            $ngo->setSocialName("ONG {$i}");
            $ngo->setFiscalCode("40-111111/0001{$i}");
            $ngo->setSite("www.ong{$i}.org");
            $ngo->setPhone("85999999999");
            $ngo->setAddress($address);
            $ngo->setCreatedAt(new \DateTime());
            $ngo->setUpdatedAt(new \DateTime());

            $manager->persist($address);
            $manager->persist($ngo);
        }

        $manager->flush();
    }
}
