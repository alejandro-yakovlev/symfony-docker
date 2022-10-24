<?php

declare(strict_types=1);

namespace App\Companies\Domain\Specification;

use App\Companies\Domain\Entity\Company\Company;
use App\Companies\Domain\Repository\CompanyRepositoryInterface;
use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Specification\SpecificationInterface;

class UniqueCompanyNameSpecification implements SpecificationInterface
{
    public function __construct(private readonly CompanyRepositoryInterface $companyRepository)
    {
    }

    public function satisfy(Company $company): void
    {
        $ownerCompanies = $this->companyRepository->findByOwner($company->getOwner()->getId());
        foreach ($ownerCompanies as $ownerCompany) {
            AssertService::notEq(
                $ownerCompany->getName(),
                $company->getName(),
                'Компания со схожим названием уже существует'
            );
        }
    }
}
