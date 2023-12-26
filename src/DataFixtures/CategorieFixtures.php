<?php

namespace App\DataFixtures;

use App\Factory\CategorieFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CategorieFactory::createOne(['nom' => 'Entrée']);
        CategorieFactory::createOne(['nom' => 'Plat']);
        CategorieFactory::createOne(['nom' => 'Dessert']);

        $manager->flush();
    }
}
