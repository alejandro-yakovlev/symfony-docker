<?php

declare(strict_types=1);

namespace App\Users\Application\Public;

use App\Shared\Application\Query\QueryBusInterface;
use App\Users\Application\Public\Query\FindUser\FindUserQuery;
use App\Users\Application\Public\Query\FindUser\FindUserQueryResult;

readonly class PublicQueryInteractor
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function findUser(FindUserQuery $query): FindUserQueryResult
    {
        return $this->queryBus->execute($query);
    }
}
