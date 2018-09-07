<?php
declare(strict_types=1);

namespace Test\Functional\Factory;

use IamPersistent\SwiftMailer\Factory\SmtpTransportFactory;

use FunctionalTester;
use Swift_Transport_EsmtpTransport;

class SmtpTransportFactoryCest
{
    public function testInvoke(FunctionalTester $I)
    {
        $config = [
            'spool'     => [
                'type' => 'memory',
            ],
            'transport' => 'smtp',
            'host'      => 'smtp.mailtrap.io',
            'username'  => 'xxxx',
            'password'  => 'xxxx',
            'auth_mode' => 'cram-md5',
            'port'      => 2525,
        ];
        /** @var Swift_Transport_EsmtpTransport $transport */
        $transport = (new SmtpTransportFactory)($config);

        $I->assertInstanceOf(Swift_Transport_EsmtpTransport::class, $transport);
        $I->assertSame($config['host'], $transport->getHost());
        $I->assertSame($config['port'], $transport->getPort());
        $I->assertSame(30, $transport->getTimeout());

    }
}
