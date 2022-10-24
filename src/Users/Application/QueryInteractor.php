<?php

declare(strict_types=1);

namespace App\Users\Application;

use App\Shared\Application\Query\QueryBusInterface;
use App\Users\Application\Query\FindUser\FindUserQuery;
use App\Users\Application\Query\FindUser\FindUserQueryResult;

class QueryInteractor
{
    public function __construct(private readonly QueryBusInterface $queryBus)
    {
    }

    public function findUser(FindUserQuery $query): FindUserQueryResult
    {
        return $this->queryBus->execute($query);
    }
}
