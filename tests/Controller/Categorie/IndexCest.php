<?php

namespace App\Tests\Controller\Categorie;

use App\Factory\AllergeneFactory;
use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function tryToTest(ControllerTester $I)
    {
        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_USER'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/categorie');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Catégories');
        $I->see('Toutes les recettes par catégorie', 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $categorie = CategorieFactory::createOne();
        RecetteFactory::createOne(['categorie' => $categorie]);

        $I->amOnPage('/categorie');
        $I->seeCurrentRouteIs('app_login');
    }

    public function clickFirstLink(ControllerTester $I): void
    {
        CategorieFactory::createOne();

        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_USER'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/categorie');
        $I->click('.btn-primary');
        $I->seeCurrentRouteIs('recette_categorie');
    }
}
