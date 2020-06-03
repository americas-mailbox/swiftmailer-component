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
          if($party && $party->getEmail() && $party->getName()){
              $returnData[$party->getEmail()] = $party->getName();
          }elseif($party && $party->getEmail()){
              $returnData[] = $party->getEmail();
          }
      }

        return $returnData;
    }
}