<?php

namespace App\Testing\Application\Query\FindTestingSession;

use App\Shared\Application\Query\Query;

readonly class FindTestingSessionQuery extends Query
{
    public function __construct(public string $testingSessionId)
    {
    }
}
