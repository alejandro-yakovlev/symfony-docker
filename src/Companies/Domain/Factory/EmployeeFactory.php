<?php

declare(strict_types=1);

namespace App\Companies\Domain\Factory;

use App\Companies\Domain\Entity\Company\Company;
use App\Companies\Domain\Entity\Employee\Contact;
use App\Companies\Domain\Entity\Employee\Employee;
use App\Shared\Domain\Entity\ValueObject\NullableUserUlid;

class EmployeeFactory
{
    public function create(string $userId, Contact $contact, Company $company): Employee
    {
        $entity = new Employee($contact, $company);
        $entity->setUser(NullableUserUlid::fromString($userId));

        return $entity;
    }

    public function createCandidate(Contact $contact, Company $company): Employee
    {
        return new Employee($contact, $company);
    }
}
