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
        $repertoire = __DIR__;
        $contenuFichier = file_get_contents("{$repertoire}\data\Allergene.json");
        $contenuFichierDecode = json_decode($contenuFichier);

        foreach ($contenuFichierDecode as $element) {
            $name = $element->nom;
            $description = $element->description;
            AllergeneFactory::createOne(['nom' => $name, 'description' => $description]);
        }
    }
}
