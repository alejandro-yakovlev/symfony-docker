<?php

declare(strict_types=1);

namespace App\Companies\Application\Query\GetCompanies;

use App\Companies\Application\DTO\CompanyDTO;
use App\Companies\Domain\Repository\CompanyFilter;
use App\Companies\Domain\Repository\CompanyRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Repository\Pager;

class GetCompaniesQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly CompanyRepositoryInterface $companyRepository)
    {
    }

    public function __invoke(GetCompaniesQuery $query): GetCompaniesQueryResult
    {
        $filter = new CompanyFilter($query->pager);
        $paginator = $this->companyRepository->findByFilter($filter);
        $pager = new Pager($query->pager->page, $query->pager->perPage, $paginator->total);

        return new GetCompaniesQueryResult(CompanyDTO::fromArray($paginator->items), $pager);
    }
}
