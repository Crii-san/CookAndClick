<?php


namespace App\Tests\Controller\Recette;

use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use App\Tests\Support\ControllerTester;

class ShowCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests
    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $categorie = CategorieFactory::createOne();
        RecetteFactory::createOne(['categorie' => $categorie]);
        $I->amOnPage('/recette/1');
        $I->seeCurrentRouteIs('app_login');
    }
}
