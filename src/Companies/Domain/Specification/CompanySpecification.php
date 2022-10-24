<?php

declare(strict_types=1);

namespace App\Companies\Domain\Specification;

use App\Shared\Domain\Specification\SpecificationInterface;

class CompanySpecification implements SpecificationInterface
{
    public function __construct(public readonly UniqueCompanyNameSpecification $nameSpecification)
    {
    }
}
