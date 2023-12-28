<?php

namespace App\DataFixtures;

use App\Factory\AllergeneFactory;
use App\Factory\IngredientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 15; ++$i) {
            $var = AllergeneFactory::random();
            IngredientFactory::createOne(['allergenes' => [$var]]);
        }
        for ($i = 1; $i <= 35; ++$i) {
            IngredientFactory::createOne();
        }
    }
}
