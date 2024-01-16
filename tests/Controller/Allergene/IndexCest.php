<?php

namespace App\Tests\Controller\Allergene;

use App\Factory\AllergeneFactory;
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

    public function controlSortRecette(ControllerTester $I): void
    {
        AllergeneFactory::createSequence([
            ['nom' => 'P'],
            ['nom' => 'M'],
            ['nom' => 'Z'],
            ['nom' => 'A'],
        ]);

        $expected = [
            'A',
            'M',
            'P',
            'Z',
        ];

        $I->amOnPage('/allergene');

        $listRecette = $I->grabMultiple('.allergene');

        $I->assertEquals($expected, $listRecette, "L'ordre est incorrect");
    }
}
