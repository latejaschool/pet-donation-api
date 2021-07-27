<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Breed;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class UserFixtures extends Fixture
{

    public const USER_QUANTITY = 50;

    public function load(ObjectManager $manager)
    {
        $password = password_hash('12345678', PASSWORD_ARGON2I);

        for ($i = 1; $i <= self::USER_QUANTITY; $i++) {
            $user = new User();
            $user->setName("Usuário Teste{$i}");
            $user->setEmail("teste{$i}@gmail.com");
            $user->setPhoto('https://i1.wp.com/www.institutoniemeyer.org/wp-content/uploads/2018/09/teste.png');
            $user->setCreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());
            $user->setPassword($password);
            $user->setPhone('8599999999');
            $user->setRoles([]);
            $user->setStatus(true);
            $user->setId(Uuid::v4());

            $manager->persist($user);
        }

        $manager->flush();
    }

}

