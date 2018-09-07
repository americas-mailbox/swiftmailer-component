<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Factory;

use Swift_SendmailTransport;

final class SendmailTransportFactory
{
    public function __invoke(array $config): Swift_SendmailTransport
    {
        return new Swift_SendmailTransport();
    }
}