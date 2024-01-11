<?php

namespace App\DataFixtures;

use App\Factory\EtapeFactory;
use App\Factory\IngredientFactory;
use App\Repository\RecetteRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EtapeFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(RecetteRepository $recetteRepository)
    {
        $this->recetteRepository = $recetteRepository;
    }

    public function load(ObjectManager $manager): void
    {
        // Etapes de la recette Pizza
        $repertoire = __DIR__;
        $contenuFichier = file_get_contents("{$repertoire}\data\Etape_pizza.json");
        $contenuFichierDecode = json_decode($contenuFichier);

        $numero = 1;

        foreach ($contenuFichierDecode as $element) {
            $description = $element->description;

            EtapeFactory::createOne(
                ['description' => $description,
                 'numero' => $numero,
                    'ingredients' => [IngredientFactory::random()],
                    'recette' => $this->recetteRepository->find(3)]);
            ++$numero;
        }

        // Etapes de la recette salade
        $repertoire = __DIR__;
        $contenuFichier = file_get_contents("{$repertoire}\data\Etape_salade_tomate.json");
        $contenuFichierDecode = json_decode($contenuFichier);

        $numero = 1;

        foreach ($contenuFichierDecode as $element) {
            $description = $element->description;

            EtapeFactory::createOne(
                ['description' => $description,
                    'numero' => $numero,
                    'ingredients' => [IngredientFactory::random()],
                    'recette' => $this->recetteRepository->find(2)]);
            ++$numero;
        }

        // Etapes de la recette Gateau au chocolat
        $repertoire = __DIR__;
        $contenuFichier = file_get_contents("{$repertoire}\data\Etape_gateau_chocolat.json");
        $contenuFichierDecode = json_decode($contenuFichier);

        $numero = 1;

        foreach ($contenuFichierDecode as $element) {
            $description = $element->description;

            EtapeFactory::createOne(
                ['description' => $description,
                    'numero' => $numero,
                    'ingredients' => [IngredientFactory::random()],
                    'recette' => $this->recetteRepository->find(1)]);
            ++$numero;
        }

        // Etapes créées aléatoirement
        EtapeFactory::createMany(90, function () {
            $nbIngredients = rand(0, 5);
            $nb = rand(4, 13);

            $ingredients = [];
            for ($i = 0; $i < $nbIngredients; ++$i) {
                $ingredients[] = IngredientFactory::random();
            }

            return [
                'recette' => $this->recetteRepository->find($nb),
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
