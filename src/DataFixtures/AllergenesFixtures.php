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
        foreach (json_decode(file_get_contents('data/Allergene.json', __DIR__), true) as $allergene) {
            AllergeneFactory::createOne($allergene);

        }
    }
}
