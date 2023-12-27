<?php

namespace App\DataFixtures;

use App\Factory\RecetteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class RecetteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        RecetteFactory::createMany(100, function () {
            $hasCategory = CategorieFactory::faker()->boolean(90);
            if ($hasCategory) {
                return [
                    'categorie' => CategorieFactory::random(),
                ];
            } else {
                return [];
            }
        });
    }

    public function getDependencies(): array
    {
        return [
            CategorieFactory::class,
        ];
    }
}
