<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Interactor;

use IamPersistent\SwiftMailer\Context\EmailContext;
use Swift_Mailer;
use Swift_Message;

final class SendEmail
{
    private $directories;
    private $swiftMailer;

    public function __construct(Swift_Mailer $swiftMailer, array $directories)
    {
        $this->directories = $directories;
        $this->swiftMailer = $swiftMailer;
    }

    public function send(EmailContext $context)
    {
        $message = (new Swift_Message)
            ->setTo((new PreparePartyForMessage)($context->getTo()))
            ->setSubject($context->getSubject());

        $this->swiftMailer->send($message);
    }
}