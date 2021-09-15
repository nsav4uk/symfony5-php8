<?php

declare(strict_types=1);

namespace App\Event;

final class UserCreatedEvent
{
    public function __construct(
        private string $email,
        private string $name
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
