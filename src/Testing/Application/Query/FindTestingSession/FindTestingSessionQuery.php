<?php

namespace App\Testing\Application\Query\FindTestingSession;

use App\Shared\Application\Query\Query;
use App\Shared\Application\Query\QueryInterface;

class FindTestingSessionQuery extends Query implements QueryInterface
{
    public function __construct(public readonly string $testingSessionId)
    {
    }
}
