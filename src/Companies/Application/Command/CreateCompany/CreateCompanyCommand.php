<?php

declare(strict_types=1);

namespace App\Companies\Application\Command\CreateCompany;

use App\Companies\Domain\Entity\Company\ContactPerson;
use App\Shared\Application\Command\Command;

class CreateCompanyCommand extends Command
{
    public function __construct(
        public readonly string $name,
        public readonly ContactPerson $contactPerson
    ) {
    }
}
