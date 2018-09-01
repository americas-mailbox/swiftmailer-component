<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Context;

final class EmailContext
{
    /** @var string */
    private $body;
    /** @var string */
    private $charset;
    /** @var string */
    private $contentType;
    /** @var PartyContext[] */
    private $from = [];
    /** @var string */
    private $subject;
    /** @var string */
    private $template;
    /** @var PartyContext[] */
    private $to = [];

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): EmailContext
    {
        $this->body = $body;

        return $this;
    }

    public function getCharset(): string
    {
        return $this->charset;
    }

    public function setCharset(string $charset): EmailContext
    {
        $this->charset = $charset;

        return $this;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType): EmailContext
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function getFrom(): array
    {
        return $this->from;
    }

    public function setFrom(array $from): EmailContext
    {
        $this->from = $from;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): EmailContext
    {
        $this->subject = $subject;

        return $this;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): EmailContext
    {
        $this->template = $template;

        return $this;
    }

    public function getTo(): array
    {
        return $this->to;
    }

    public function setTo(array $to): EmailContext
    {
        $this->to = $to;

        return $this;
    }
}