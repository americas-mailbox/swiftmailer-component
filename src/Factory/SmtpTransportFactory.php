<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Factory;

use Swift_Events_SimpleEventDispatcher;
use Swift_StreamFilters_StringReplacementFilterFactory;
use Swift_Transport_Esmtp_Auth_CramMd5Authenticator;
use Swift_Transport_Esmtp_Auth_LoginAuthenticator;
use Swift_Transport_Esmtp_Auth_PlainAuthenticator;
use Swift_Transport_Esmtp_AuthHandler;
use Swift_Transport_EsmtpTransport;
use Swift_Transport_StreamBuffer;

final class SmtpTransportFactory
{
    public function __invoke(array $config): Swift_Transport_EsmtpTransport
    {
        $smtpAuthHandler = new Swift_Transport_Esmtp_AuthHandler(
            [
                new Swift_Transport_Esmtp_Auth_CramMd5Authenticator(),
                new Swift_Transport_Esmtp_Auth_LoginAuthenticator(),
                new Swift_Transport_Esmtp_Auth_PlainAuthenticator(),
            ]
        );
        $smtpAuthHandler->setUsername($config['username']);
        $smtpAuthHandler->setPassword($config['password']);
        $smtpAuthHandler->setAuthMode($config['authMode']);
        $transport = new Swift_Transport_EsmtpTransport(
            new Swift_Transport_StreamBuffer(new Swift_StreamFilters_StringReplacementFilterFactory()),
            [$smtpAuthHandler],
            new Swift_Events_SimpleEventDispatcher()
        );
        $transport
            ->setHost($config['host'])
            ->setPort($config['port'])
            ->setEncryption($config['encryption'])
            ->setTimeout($config['timeout'])
            ->setSourceIp($config['sourceIp']);

        return $transport;
    }
}