<?php

namespace App\Tests\Controller\User;

use App\Factory\AllergeneFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function accessIsRestrictedToAdminUsers(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_USER'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $I->amOnPage('/user');
        $I->see('Vous n\'avez pas la permission d\'accéder à cette page.', 'p');
    }
}
