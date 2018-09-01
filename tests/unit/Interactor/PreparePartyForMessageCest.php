<?php
declare(strict_types=1);

namespace Tests\Unit\Interactor;

use IamPersistent\SwiftMailer\Context\PartyContext;
use IamPersistent\SwiftMailer\Interactor\PreparePartyForMessage;
use UnitTester;

class PreparePartyForMessageCest
{
    public function testInvoke(UnitTester $I)
    {
        $parties = [
            new PartyContext('jules@hotmail.com', 'Jules Winnfield'),
            new PartyContext('vincent@aol.com', 'Vincent Vega'),
            new PartyContext('brett@what.net'),
        ];
        $processed = (new PreparePartyForMessage)($parties);

        $I->assertSame($this->expected(), $processed);
    }

    public function expected(): array
    {
        return [
            'jules@hotmail.com' => 'Jules Winnfield',
            'vincent@aol.com' => 'Vincent Vega',
            'brett@what.net',
        ];
    }
}
