<?php

namespace App\Tests\Controller\Categorie;

use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $categorie = CategorieFactory::createOne();
        RecetteFactory::createOne(['categorie' => $categorie]);

        $I->amOnPage('/categorie');
        $I->seeCurrentRouteIs('app_login');
    }
}
