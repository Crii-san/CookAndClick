<?php


namespace App\Tests\Controller\User;

use App\Factory\AllergeneFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class ShowCest
{
    public function showInformationsAboutUser(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();

        UserFactory::createOne(['nom' => 'Uzumaki', 'prenom' => 'Naruto', 'allergene' => $allergene]);

        $user = UserFactory::createOne(['roles' => ['ROLE_ADMIN'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/user/1');

        $I->seeInTitle('Mon compte');
        $I->see('Uzumaki Naruto', 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        UserFactory::createOne(['nom' => 'Uzumaki', 'prenom' => 'Naruto', 'allergene' => $allergene]);

        $I->amOnPage('/user/1');
        $I->seeCurrentRouteIs('app_login');
    }

}
