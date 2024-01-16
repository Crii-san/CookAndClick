<?php


namespace App\Tests\Controller\User;

use App\Factory\AllergeneFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class DeleteCest
{
    public function showInformationsAboutUser(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();

        UserFactory::createOne(['nom' => 'Uzumaki', 'prenom' => 'Naruto', 'allergene' => $allergene]);

        $user = UserFactory::createOne(['roles' => ['ROLE_ADMIN'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/user/delete/1');

        $I->seeInTitle('Suppression de Uzumaki Naruto');
        $I->see('Suppression de Uzumaki Naruto', 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        UserFactory::createOne(['nom' => 'Uzumaki', 'prenom' => 'Naruto', 'allergene' => $allergene]);

        $I->amOnPage('/user/delete/1');
        $I->seeCurrentRouteIs('app_login');
    }

    public function accessIsRestrictedToAdminUsers(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        UserFactory::createOne(['allergene' => $allergene]);

        $I->amOnPage('/user/delete/2');
        $I->see('Vous n\'avez pas la permission de supprimer cet utilisateur.', 'p');
    }

    public function accessIsRestrictedToCorrespondingUser(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        UserFactory::createMany(4);

        // Utilisateur numéro 5
        $user = UserFactory::createOne(['allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        // L'utilisateur numéro 5 connecté veut accéder à la page de suppression de l'utilisateur numéro 1
        $I->amOnPage('/user/delete/1');
        $I->see('Vous n\'avez pas la permission de supprimer cet utilisateur.', 'p');
    }
}
