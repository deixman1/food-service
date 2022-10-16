<?php

declare(strict_types=1);

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class SearchCest
{
    // tests
    public function tryToTest(AcceptanceTester $I): void
    {
        $I->amOnPage('/search-food?query=apple');
    }
}
