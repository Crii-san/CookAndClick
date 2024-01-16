<?php

namespace App\Tests\Controller\User;

use App\Factory\AllergeneFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function tryToTest(ControllerTester $I)
    {
        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_ADMIN'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/user');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Tous les utilisateurs');
        $I->see('Tous les utilisateurs', 'h1');
    }

    public function accessIsRestrictedToAdminUsers(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_USER'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/user');
        $I->see('Vous n\'avez pas la permission d\'accéder à cette page.', 'p');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $I->amOnPage('/user');
        $I->seeCurrentRouteIs('app_login');
    }

    public function clickFirstLink(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_ADMIN'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        // test
        $I->amOnPage('/user');
        $I->click('.utilisateurs');
        $I->seeCurrentRouteIs('app_user_show');
    }

    public function controlSortUser(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        UserFactory::createSequence([
            ['nom' => 'C', 'prenom' => 'Jean', 'allergene' => $allergene],
            ['nom' => 'Z', 'prenom' => 'Jean', 'allergene' => $allergene],
            ['nom' => 'E', 'prenom' => 'Bjean', 'allergene' => $allergene],
            ['nom' => 'E', 'prenom' => 'Ajean', 'allergene' => $allergene],
        ]);

        $expected = [
            'C Jean',
            'E Ajean',
            'E Bjean',
            'Z Jean',
            'Z Z',
        ];

        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['nom' => 'Z', 'prenom' => 'Z', 'roles' => ['ROLE_ADMIN'], 'allergene' => $allergene]);

        $I->amLoggedInAs($user->object());
        $I->amOnPage('/user');
        $listUser = $I->grabMultiple('.utilisateur');
        $I->assertEquals($expected, $listUser, "L'ordre est incorrect");
    }
}
