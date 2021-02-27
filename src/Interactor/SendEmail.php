<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Interactor;

use IamPersistent\SwiftMailer\Context\EmailContext;
use Swift_Mailer;
use Swift_Message;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class SendEmail
{
    private $swiftMailer;
    private $twig;

    public function __construct(Swift_Mailer $swiftMailer, array $directories)
    {
        $twigOptions = [
            'autoescape' => false,
        ];
        $loader = new FilesystemLoader($directories);
        $this->twig = new Environment($loader, $twigOptions);
        $this->swiftMailer = $swiftMailer;
    }

    public function send(EmailContext $context)
    {
        $body = $context->getBody();
        $subject = $context->getSubject();
        if ($template = $context->getTemplate()) {
            $templateContext = array_merge([
                '_body' => $body,
                '_subject' => $subject,
            ], $context->getBodyContext());
            $body = $this->twig->render($template, $templateContext);
        }

        $message = (new Swift_Message)
            ->setBody($body, 'text/html')
            ->setFrom((new PreparePartyForMessage)($context->getFrom()))
            ->setReplyTo((new PreparePartyForMessage)($context->getReplyTo()))
            ->setSubject($subject)
            ->setTo((new PreparePartyForMessage)($context->getTo()));
        if (!empty($context->getBcc())) {
            $message->setBcc((new PreparePartyForMessage)($context->getBcc()));
        }

        $this->swiftMailer->send($message);
    }
}
