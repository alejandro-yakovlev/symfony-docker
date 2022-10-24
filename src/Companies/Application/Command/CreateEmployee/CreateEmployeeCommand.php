<?php

declare(strict_types=1);

namespace App\Companies\Application\Command\CreateEmployee;

use App\Companies\Domain\Entity\Employee\Contact;
use App\Shared\Application\Command\Command;

class CreateEmployeeCommand extends Command
{
    public function __construct(
        public readonly Contact $contact,
        public readonly string $companyId
    ) {
    }
}
