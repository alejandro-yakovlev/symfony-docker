<?php

declare(strict_types=1);

namespace App\Users\Application\UseCase;

use App\Shared\Application\Query\QueryBusInterface;
use App\Users\Application\UseCase\Query\FindUser\FindUserQuery;
use App\Users\Application\UseCase\Query\FindUser\FindUserQueryResult;

readonly class PublicUseCaseInteractor
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function findUser(FindUserQuery $query): FindUserQueryResult
    {
        return $this->queryBus->execute($query);
    }
}
