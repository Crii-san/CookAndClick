<?php

namespace App\DataFixtures;

use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use App\Repository\CategorieRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RecetteFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(CategorieRepository $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $repertoire = __DIR__;
        $contenuFichier = file_get_contents("{$repertoire}\data\Recette.json");
        $contenuFichierDecode = json_decode($contenuFichier);

        foreach ($contenuFichierDecode as $element) {
            $nom = $element->nom;
            $niv_difficulte = $element->niv_difficulte;
            $description = $element->description;
            $nb_personne = $element->nb_personne;
            $minutes = $element->minutes;
            $heures = $element->heures;

            $categorieValue = $element->categorie;
            if (1 == $categorieValue) {
                $categorie = $this->categorieRepository->findByName('Entrée');
            } elseif (2 == $categorieValue) {
                $categorie = $this->categorieRepository->findByName('Plat');
            } else {
                $categorie = $this->categorieRepository->findByName('Dessert');
            }

            RecetteFactory::createOne(
                ['nom' => $nom,
                'niv_difficulte' => $niv_difficulte,
                'description' => $description,
                'nb_personne' => $nb_personne,
                'minutes' => $minutes,
                'heures' => $heures,
                'categorie' => $categorie]);
        }

        RecetteFactory::createMany(10, function () {
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
