<?php

declare(strict_types=1);

namespace App\Companies\Domain\Entity\Company;

class ContactPerson
{
    public function __construct(
        public readonly string $firstname,
        public readonly string $lastname,
        public readonly string $email,
        public readonly ?string $phoneNumber,
    ) {
    }
}
