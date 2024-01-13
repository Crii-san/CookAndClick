<?php

namespace App\Tests\Controller\Recette;

use App\Factory\AllergeneFactory;
use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class ShowCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests
    public function tryToTest(ControllerTester $I): void
    {
        $categorie = CategorieFactory::createOne();
        RecetteFactory::createOne(['nom' => 'Pâtes au beurre', 'categorie' => $categorie]);

        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_USER'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/recette/1');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Pâtes au beurre');
        $I->see('Pâtes au beurre', 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $categorie = CategorieFactory::createOne();
        RecetteFactory::createOne(['categorie' => $categorie]);
        $I->amOnPage('/recette/1');
        $I->seeCurrentRouteIs('app_login');
    }
}
