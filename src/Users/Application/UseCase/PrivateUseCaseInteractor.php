<?php

declare(strict_types=1);

namespace App\Users\Application\UseCase;

use App\Shared\Application\Query\QueryBusInterface;
use App\Users\Application\UseCase\Query\GetMe\GetMeQuery;
use App\Users\Application\UseCase\Query\GetMe\GetMeQueryResult;

readonly class PrivateUseCaseInteractor
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function getMe(): GetMeQueryResult
    {
        return $this->queryBus->execute(new GetMeQuery());
    }
}
