<?php

namespace App\DataFixtures;

use App\Factory\AllergeneFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        $proba = $faker->boolean(90);
        if ($proba) {
            $allergene = AllergeneFactory::random();
        } else {
            $allergene = null;
        }

        UserFactory::createOne(['nom' => 'Souka', 'prenom' => 'Christelle', 'email' => 'christelle@example.com', 'roles' => ['ROLE_ADMIN']]);
        UserFactory::createOne(['nom' => 'Martinet', 'prenom' => 'Line', 'email' => 'line@example.com', 'roles' => ['ROLE_ADMIN']]);
        UserFactory::createOne(['nom' => 'Bouhriz El Bouhlali', 'prenom' => 'Yasmina', 'email' => 'yasmina@example.com', 'roles' => ['ROLE_ADMIN']]);
        UserFactory::createOne(['nom' => 'Fontao', 'prenom' => 'Thomas', 'email' => 'thomas@example.com', 'roles' => ['ROLE_ADMIN']]);


        UserFactory::createMany(10, function () {
            $faker = Faker\Factory::create();
            $proba = $faker->boolean(20);
            if ($proba) {
                return ['allergene' => AllergeneFactory::random()];
            } else {
                return ['allergene' => null];
            }
        });

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AllergenesFixtures::class,
        ];
    }
}
