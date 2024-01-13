<?php


namespace App\Tests\Controller\Recette;

use App\Factory\AllergeneFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class CreateCest
{
    public function form(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        $post = UserFactory::createOne(['roles' => ['ROLE_USER'], 'allergene' => $allergene]);
        $realPost = $post->object();
        $I->amLoggedInAs($realPost);

        $I->amOnPage('/recette/create');

        $I->seeInTitle("Création d'une nouvelle recette");
        $I->see("Création d'une nouvelle recette", 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $I->amOnPage('/recette/create');
        $I->seeCurrentRouteIs('app_login');
    }
}
