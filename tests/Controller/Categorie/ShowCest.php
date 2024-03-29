<?php


namespace App\Tests\Controller\Categorie;

use App\Factory\AllergeneFactory;
use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class ShowCest
{
    public function tryToTest(ControllerTester $I)
    {
        CategorieFactory::createOne(['nom' => 'Les entrées']);

        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_USER'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/categorie/1');
        $I->seeInTitle('Les entrées');
        $I->see('Les entrées', 'h1');
    }

    public function clickFirstLink(ControllerTester $I): void
    {
        $categorie = CategorieFactory::createOne();
        RecetteFactory::createOne(['nom' => 'Test', 'categorie' => $categorie]);

        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_USER'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/categorie/1');
        $I->click('.btn-primary');
        $I->seeCurrentRouteIs('app_recette_show');
    }
}
