<?php

namespace App\DataFixtures;

use App\Factory\EtapeFactory;
use App\Factory\IngredientFactory;
use App\Factory\RecetteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EtapeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        EtapeFactory::createMany(200, function () {
            $nbIngredients = rand(0, 5);

            $ingredients = [];
            for ($i = 0; $i < $nbIngredients; ++$i) {
                $ingredients[] = IngredientFactory::random();
            }

            return [
                'recette' => RecetteFactory::random(),
                'ingredients' => $ingredients,
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
