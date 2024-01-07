<?php

namespace App\DataFixtures;

use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RecetteFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        RecetteFactory::createMany(20, function () {
            return [
                'categorie' => CategorieFactory::random(),
            ];
        });
    }

    public function getDependencies(): array
    {
        return [
            CategorieFixtures::class,
        ];
    }
}
