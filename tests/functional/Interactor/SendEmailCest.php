<?php
declare(strict_types=1);

namespace Tests\Functional\Interactor;

use IamPersistent\SwiftMailer\Context\EmailContext;
use IamPersistent\SwiftMailer\Context\PartyContext;
use IamPersistent\SwiftMailer\Interactor\SendEmail;
use FunctionalTester;
use Swift_Mailer;
use Swift_NullTransport;
use Swift_Plugins_MessageLogger;

class SendEmailCest
{
    public function testSend(FunctionalTester $I)
    {
        $transport = new Swift_NullTransport();
        $swiftMailer = new Swift_Mailer($transport);
        $logger = new Swift_Plugins_MessageLogger();
        $swiftMailer->registerPlugin($logger);

        $body = <<<BODY
<p>Look, just because I don't be givin' no man a foot massage don't make it right for Marsellus to throw Antwone into a 
glass motherfuckin' house, fuckin' up the way the nigger talks. Motherfucker do that shit to me, he better paralyze my 
ass, 'cause I'll kill the motherfucker, know what I'm sayin'?</p>
BODY;
        $subject = 'Foot Massages';
        $context = (new EmailContext())
            ->setBody($body)
            ->setFrom([new PartyContext('jules@hotmail.com', 'Jules Winnfield')])
            ->setSubject($subject)
            ->setTemplate('test.html.twig')
            ->setTo([new PartyContext('vincent@aol.com', 'Vincent Vega')]);

        (new SendEmail($swiftMailer, [__DIR__ . '/../../_support/views']))->send($context);
        $emails = $logger->getMessages();
        $I->assertCount(1, $emails);
        $message = $emails[0];
        $I->assertSame($this->expectedBody(), $message->getBody());
        $I->assertSame(['jules@hotmail.com' => 'Jules Winnfield'], $message->getFrom());
        $I->assertSame(['vincent@aol.com' => 'Vincent Vega'], $message->getTo());
        $I->assertSame($subject, $message->getSubject());
    }

    private function expectedBody(): string
    {
        return <<<BODY
<html>
    <head>
        <title>Foot Massages</title>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <p>Look, just because I don't be givin' no man a foot massage don't make it right for Marsellus to throw Antwone into a 
glass motherfuckin' house, fuckin' up the way the nigger talks. Motherfucker do that shit to me, he better paralyze my 
ass, 'cause I'll kill the motherfucker, know what I'm sayin'?</p>
                </td>
            </tr>
        </table>
    </body>
</html>
BODY;
    }
}
