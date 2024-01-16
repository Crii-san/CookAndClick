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
}
