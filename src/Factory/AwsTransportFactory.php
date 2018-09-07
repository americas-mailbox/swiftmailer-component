<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Factory;

final class AwsTransportFactory
{
    public function __invoke(array $config): Swift_AWSTransport
    {
        return new Swift_AWSTransport(
            $config['username'],
            $config['password'],
            true,
            $config['host']
        );
    }
}