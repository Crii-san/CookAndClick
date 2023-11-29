<?php

namespace App\DataFixtures;

use App\Factory\AllergeneFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class AllergenesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AllergeneFactory::createMany(14);
    }
}
