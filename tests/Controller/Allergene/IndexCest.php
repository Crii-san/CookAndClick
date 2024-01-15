<?php


namespace App\Tests\Controller\Allergene;

use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function tryToTest(ControllerTester $I)
    {
        $I->amOnPage('/allergene');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Tous les allergènes');
        $I->see('Tous les allergènes', 'h1');
    }
}
