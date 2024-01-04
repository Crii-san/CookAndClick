<?php

namespace App\DataFixtures;

use App\Factory\EtapeFactory;
use App\Factory\RecetteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtapeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        EtapeFactory::createMany(50, function () {
            return [
                'recette' => RecetteFactory::random(),
            ];
        });
    }

    public function getDependencies(): array
    {
        return [
            RecetteFixtures::class,
        ];
    }
}
