<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne(['nom' => 'Souka', 'prenom' => 'Christelle', 'email' => 'christelle@example.com', 'roles' => ['ROLE_ADMIN']]);
        UserFactory::createOne(['nom' => 'Martinet', 'prenom' => 'Line', 'email' => 'line@example.com', 'roles' => ['ROLE_ADMIN']]);
        UserFactory::createOne(['nom' => 'Bouhriz El Bouhlali', 'prenom' => 'Yasmina', 'email' => 'yasmina@example.com', 'roles' => ['ROLE_ADMIN']]);
        UserFactory::createOne(['nom' => 'Fontao', 'prenom' => 'Thomas', 'email' => 'thomas@example.com', 'roles' => ['ROLE_ADMIN']]);
        for ($i = 0; $i < 10; ++$i) {
            UserFactory::createOne();
        }

        $manager->flush();
    }
}
