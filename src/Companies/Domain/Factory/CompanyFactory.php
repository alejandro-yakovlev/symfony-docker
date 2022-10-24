<?php

declare(strict_types=1);

namespace App\Companies\Domain\Factory;

use App\Companies\Domain\Entity\Company\Company;
use App\Companies\Domain\Entity\Company\ContactPerson;
use App\Companies\Domain\Specification\CompanySpecification;
use App\Shared\Domain\Entity\ValueObject\UserUlid;

class CompanyFactory
{
    public function __construct(private readonly CompanySpecification $companySpecification)
    {
    }

    public function create(string $ownerId, string $name, ContactPerson $contactPerson): Company
    {
        return new Company($this->companySpecification, UserUlid::fromString($ownerId), $name, $contactPerson);
    }
}
