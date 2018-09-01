<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Interactor;

use IamPersistent\SwiftMailer\Context\PartyContext;

final class PreparePartyForMessage
{
    public function __invoke(array $parties)
    {
        $returnData = [];

        /** @var PartyContext $party */
        foreach ($parties as $party) {
            $email = $party->getEmail();
            if ($name = $party->getName()) {
                $returnData[$email] = $name;
            } else {
                $returnData[] = $email;
            }
        }

        return $returnData;
    }
}