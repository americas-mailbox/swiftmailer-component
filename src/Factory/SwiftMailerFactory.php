<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Factory;

use Psr\Container\ContainerInterface;
use Swift_Mailer;
use Xaddax\Interactor\GatherConfigValues;

final class SwiftMailerFactory
{
    public function __invoke(ContainerInterface $container): Swift_Mailer
    {
        $config = (new GatherConfigValues)($container, 'swiftmailer');

        $transportFactoryClass = ucfirst(strtolower($config['transport'])) . 'TransportFactory';
        $transport = (new $transportFactoryClass)($config);

        return new Swift_Mailer($transport);
    }
}