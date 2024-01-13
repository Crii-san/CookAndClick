<?php


namespace App\Tests\Controller\Recette;

use App\Factory\AllergeneFactory;
use App\Factory\CategorieFactory;
use App\Factory\RecetteFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class UpdateCest
{
    public function formShowsRecetteDataBeforeUpdating(ControllerTester $I): void
    {
        $allergene = AllergeneFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_ADMIN'], 'allergene' => $allergene]);
        $I->amLoggedInAs($user->object());

        $categorie = CategorieFactory::createOne();
        RecetteFactory::createOne(['nom' => 'Pâtes au beurre', 'categorie' => $categorie]);

        $I->amOnPage('/recette/update/1');

        $I->seeInTitle('Édition de Pâtes au beurre');
        $I->see('Édition  de la recette : Pâtes au beurre', 'h1');
    }


}
