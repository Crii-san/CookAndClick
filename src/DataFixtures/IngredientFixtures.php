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
        $repertoire = __DIR__;
        $contenuFichier = file_get_contents("{$repertoire}\data\Ingredient.json");
        $contenuFichierDecode = json_decode($contenuFichier);

        foreach ($contenuFichierDecode as $element) {
            $nom = $element->nom;
            $nbAllergene = rand(0, 3);
            $allergenes = [];

            for ($i = 0; $i < $nbAllergene; ++$i) {
                $allergenes[] = AllergeneFactory::random();
            }

            IngredientFactory::createOne(
                ['nom' => $nom,
                 'allergenes' => $allergenes]);
        }
    }
}
