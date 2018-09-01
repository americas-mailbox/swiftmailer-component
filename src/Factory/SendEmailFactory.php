<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Factory;

use IamPersistent\SwiftMailer\Interactor\SendEmail;
use Psr\Container\ContainerInterface;
use Swift_Mailer;
use Xaddax\Interactor\GatherConfigValues;

final class SendEmailFactory
{
    public function __invoke(ContainerInterface $container): SendEmail
    {
        $swiftMailer = $container->get(Swift_Mailer::class);
        $config = (new GatherConfigValues)($container, 'swiftmailer');

        return new SendEmail($swiftMailer, $config['templateDirectories']);
    }
}