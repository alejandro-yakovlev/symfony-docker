<?php

namespace App\Testing\Application\Query\FindTestingSession;

use App\Shared\Application\Query\QueryInterface;

class FindTestingSessionQuery implements QueryInterface
{
    public function __construct(public readonly string $testingSessionId)
    {
    }
}
