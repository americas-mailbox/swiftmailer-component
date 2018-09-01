<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Factory;

use Psr\Container\ContainerInterface;
use Swift_NullTransport;

final class NullTransportFactory
{
    public function __invoke(ContainerInterface $container): Swift_NullTransport
    {
        return new Swift_NullTransport();
    }
}