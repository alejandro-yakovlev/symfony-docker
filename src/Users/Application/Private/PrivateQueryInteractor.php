<?php

declare(strict_types=1);

namespace App\Users\Application\Private;

use App\Shared\Application\Query\QueryBusInterface;
use App\Users\Application\Private\Query\GetMe\GetMeQuery;
use App\Users\Application\Private\Query\GetMe\GetMeQueryResult;

readonly class PrivateQueryInteractor
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function getMe(): GetMeQueryResult
    {
        return $this->queryBus->execute(new GetMeQuery());
    }
}
