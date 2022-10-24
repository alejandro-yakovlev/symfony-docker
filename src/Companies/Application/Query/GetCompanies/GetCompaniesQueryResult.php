<?php

declare(strict_types=1);

namespace App\Companies\Application\Query\GetCompanies;

use App\Companies\Application\DTO\CompanyDTO;
use App\Shared\Domain\Repository\Pager;

class GetCompaniesQueryResult
{
    /**
     * @param CompanyDTO[] $companies
     */
    public function __construct(
        readonly public array $companies,
        readonly public Pager $pager
    ) {
    }
}
