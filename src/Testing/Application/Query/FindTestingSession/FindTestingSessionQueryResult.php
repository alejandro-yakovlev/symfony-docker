<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindTestingSession;

use App\Testing\Application\Query\DTO\TestingSessionDTO;

class FindTestingSessionQueryResult
{
    public function __construct(public readonly TestingSessionDTO $testingSession)
    {
    }
}
