<?php

namespace App\Tests\Controller\Recette;

use App\Entity\Allergene;
use App\Factory\AllergeneFactory;
use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests
    public function tryToTest(ControllerTester $I)
    {
        $I->amOnPage('/recette');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Toutes les recettes');
        $I->see('Toutes les recettes', 'h1');
    }

    public function clickFirstLink(ControllerTester $I): void
    {
        // Création d'une recette (avec sa catégorie)
        $categorie = CategorieFactory::createOne();
        RecetteFactory::createOne(['nom' => 'Pâtes au beurre', 'categorie' => $categorie]);

        // Création d'une User pour accéder à la page détail (avec son allergie)
        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_USER'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        // test
        $I->amOnPage('/recette');
        $I->click('.btn-primary');
        $I->seeCurrentRouteIs('app_recette_show');
    }
}
