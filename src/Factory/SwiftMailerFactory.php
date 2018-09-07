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
        $defaults = [
            'authMode'   => null,
            'encryption' => '',
            'host'       => null,
            'password'   => null,
            'port'       => null,
            'sourceIp'   => '',
            'timeout'    => 30,
            'username'   => null,
        ];
        $config = (new GatherConfigValues)($container, 'swiftmailer', $defaults);

        $transportFactoryClass = 'IamPersistent\\SwiftMailer\\Factory\\' . ucfirst(strtolower($config['transport'])).'TransportFactory';
        $transport = (new $transportFactoryClass)($config);

        return new Swift_Mailer($transport);
    }
}