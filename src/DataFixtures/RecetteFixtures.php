<?php

namespace App\DataFixtures;

use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecetteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        RecetteFactory::createMany(100, function () {
            return [
                'categorie' => CategorieFactory::random(),
            ];
        });
    }

    public function getDependencies(): array
    {
        return [
            CategorieFactory::class,
        ];
    }
}
