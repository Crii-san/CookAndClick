<?php

namespace App\Tests\Controller\User;

use App\Factory\AllergeneFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class UpdateCest
{
    public function formShowsUserDataBeforeUpdating(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();

        UserFactory::createOne(['nom' => 'Uzumaki', 'prenom' => 'Naruto', 'allergene' => $allergene]);

        $user = UserFactory::createOne(['roles' => ['ROLE_ADMIN'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/user/update/1');

        $I->seeInTitle('Uzumaki Naruto');
        $I->see('Édition de Uzumaki Naruto', 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        UserFactory::createOne(['nom' => 'Uzumaki', 'prenom' => 'Naruto', 'allergene' => $allergene]);

        $I->amOnPage('/user/update/1');
        $I->seeCurrentRouteIs('app_login');
    }

    public function accessIsRestrictedToAdminUsers(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();

        $user = UserFactory::createOne(['allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        UserFactory::createOne(['allergene' => $allergene]);

        $I->amOnPage('/user/update/2');
        $I->see('Vous n\'avez pas la permission de modifier cet utilisateur.', 'p');
    }

    public function accessIsRestrictedToCorrespondingUser(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        UserFactory::createMany(4);

        // Utilisateur numéro 5
        $user = UserFactory::createOne(['allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        // L'utilisateur numéro 5 connecté veut accéder à la page de modification de l'utilisateur numéro 1
        $I->amOnPage('/user/update/1');
        $I->see('Vous n\'avez pas la permission de modifier cet utilisateur.', 'p');
    }
}
