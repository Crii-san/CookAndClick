<?php


namespace App\Tests\Controller\Acceuil;

use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests
    public function tryToTest(ControllerTester $I)
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Cook&Click');
        $I->see('Les dernières recettes', 'h1');
    }

    public function search(ControllerTester $I): void
    {
        $categorie = CategorieFactory::createOne();
        for ($i = 0; $i < 2; ++$i) {
            RecetteFactory::createOne(['categorie' => $categorie]);
        }
        RecetteFactory::createOne(['nom' => 'Fondant au chocolat', 'categorie' => $categorie]);
        RecetteFactory::createOne(['nom' => 'Chocolat chaud', 'categorie' => $categorie]);

        $chercheCaractere = 'chocolat';

        $I->amOnPage('/recette?search='.$chercheCaractere);
        $I->see('Fondant au chocolat');
        $I->see('Chocolat chaud');
    }
}
