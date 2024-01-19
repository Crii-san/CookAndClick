<?php

namespace App\Tests\Controller\Etape;

use App\Factory\AllergeneFactory;
use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class CreateOKCest
{
    // tests
    public function tryToTest(ControllerTester $I)
    {
        $categorie = CategorieFactory::createOne();
        RecetteFactory::createOne(['nom' => 'Fondant au chocolat', 'categorie' => $categorie]);

        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_USER'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/etape/createOk/1');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Fondant au chocolat');
        $I->see('Nouvelle étape pour la recette : Fondant au chocolat', 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $categorie = CategorieFactory::createOne();
        RecetteFactory::createOne(['categorie' => $categorie]);

        $I->amOnPage('/etape/createOk/1');
        $I->seeCurrentRouteIs('app_login');
    }
}
