<?php


namespace App\Tests\Controller\Acceuil;

use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests
    public function tryToTest(ControllerTester $I)
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Cook&Click');
        $I->see('Les dernières recettes', 'h1');
    }

}
