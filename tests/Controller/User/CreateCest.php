<?php

namespace App\Tests\Controller\User;

use App\Tests\Support\ControllerTester;

class CreateCest
{
    public function tryToTest(ControllerTester $I)
    {
        $I->amOnPage('/user/create');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Créer mon compte');
        $I->see('Créer mon compte', 'h1');
    }
}
