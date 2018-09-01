<?php
declare(strict_types=1);

namespace Tests\Functional\Interactor;

use IamPersistent\SwiftMailer\Context\EmailContext;
use IamPersistent\SwiftMailer\Context\PartyContext;
use IamPersistent\SwiftMailer\Interactor\SendEmail;
use FunctionalTester;
use Swift_Mailer;
use Swift_NullTransport;
use Swift_Plugins_LoggerPlugin;
use Swift_Plugins_Loggers_ArrayLogger;

class SendEmailCest
{
    public function testSend(FunctionalTester $I)
    {
        $transport = new Swift_NullTransport();
        $swiftMailer = new Swift_Mailer($transport);
        $logger = new Swift_Plugins_Loggers_ArrayLogger();
        $swiftMailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));

        $body = <<<BODY
<p>Look, just because I don't be givin' no man a foot massage don't make it right for Marsellus to throw Antwone into a 
glass motherfuckin' house, fuckin' up the way the nigger talks. Motherfucker do that shit to me, he better paralyze my 
ass, 'cause I'll kill the motherfucker, know what I'm sayin'?</p>
BODY;

        $context = (new EmailContext())
            ->setBody($body)
            ->setFrom([new PartyContext('jules@hotmail.com', 'Jules Winnfield')])
            ->setSubject('Foot Massages')
            ->setTo([new PartyContext('vincent@aol.com', 'Vincent Vega')]);

        (new SendEmail($swiftMailer, []))->send($context);
        $a = 0;
    }
}
