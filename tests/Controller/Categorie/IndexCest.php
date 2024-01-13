<?php

namespace App\Tests\Controller\Categorie;

use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function tryToTest(ControllerTester $I)
    {
        $I->amOnPage('/categorie');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Catégorie');
        $I->see('Toutes les recettes par catégorie', 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $categorie = CategorieFactory::createOne();
        RecetteFactory::createOne(['categorie' => $categorie]);

        $I->amOnPage('/categorie');
        $I->seeCurrentRouteIs('app_login');
    }
}
