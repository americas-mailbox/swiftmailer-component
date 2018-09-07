<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Factory;

use Swift_NullTransport;

final class NullTransportFactory
{
    public function __invoke(array $config): Swift_NullTransport
    {
        return new Swift_NullTransport();
    }
}