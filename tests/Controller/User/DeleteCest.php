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


}
