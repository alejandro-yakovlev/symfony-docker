<?php

declare(strict_types=1);

namespace App\Companies\Domain\Entity\Employee;

class Contact
{
    public function __construct(
        public readonly string $firstname,
        public readonly string $lastname,
        public readonly string $email,
    ) {
    }
}
