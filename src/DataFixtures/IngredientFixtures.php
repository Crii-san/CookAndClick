<?php

namespace App\DataFixtures;

use App\Factory\IngredientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        IngredientFactory::createMany(100);
    }
}
