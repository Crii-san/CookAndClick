<?php


namespace App\Tests\Controller\Recette;

use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests
    public function tryToTest(ControllerTester $I)
    {
        $I->amOnPage('/recette');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Toutes les recettes');
        $I->see('Toutes les recettes', 'h1');
    }
}
