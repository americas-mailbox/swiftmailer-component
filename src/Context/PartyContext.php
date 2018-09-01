<?php
declare(strict_types=1);

namespace IamPersistent\SwiftMailer\Context;

final class PartyContext
{
    /** @var string */
    private $email;
    /** @var string|null */
    private $name;

    public function __construct(string $email, string $name = null)
    {
        $this->email = $email;
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}