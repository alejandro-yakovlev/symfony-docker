<?php

namespace App\Company\Domain\Entity\Company;

use JetBrains\PhpStorm\Immutable;

#[Immutable]
class ContactPerson
{
    public function __construct(
        private readonly string $name,
        private readonly string $phoneNumber
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
