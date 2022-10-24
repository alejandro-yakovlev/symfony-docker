<?php

declare(strict_types=1);

namespace App\Companies\Application\Query;

use App\Companies\Application\Query\GetCompanies\GetCompaniesQuery;
use App\Companies\Application\Query\GetCompanies\GetCompaniesQueryResult;
use App\Shared\Application\Query\QueryBusInterface;

class QueryInteractor
{
    public function __construct(private readonly QueryBusInterface $queryBus)
    {
    }

    public function getCompanies(GetCompaniesQuery $query): GetCompaniesQueryResult
    {
        return $this->queryBus->execute($query);
    }
}
