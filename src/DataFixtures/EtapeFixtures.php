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

    private function creationEtapes($recetteId, $jsonFilePath): void
    {
        $contenuFichierDecode = json_decode(file_get_contents(__DIR__."/data/{$jsonFilePath}"));
        $numero = 1;

        foreach ($contenuFichierDecode as $element) {
            $description = $element->description;

            EtapeFactory::createOne([
                'description' => $description,
                'numero' => $numero,
                'ingredients' => [IngredientFactory::random()],
                'recette' => $this->recetteRepository->find($recetteId),
            ]);

            ++$numero;
        }
    }

    public function load(ObjectManager $manager): void
    {
        // Etapes de la recette Pizza
        $this->creationEtapes(3, 'Etape_pizza.json');

        // Etapes de la recette Salade
        $this->creationEtapes(2, 'Etape_salade_tomate.json');

        // Etapes de la recette Gateau au chocolat
        $this->creationEtapes(1, 'Etape_gateau_chocolat.json');

        // Etapes créées aléatoirement
        EtapeFactory::createMany(70, function () {
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
