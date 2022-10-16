<?php

declare(strict_types=1);

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class IndexCest
{
    // tests
    public function tryToTest(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->see('[]');
    }
}
