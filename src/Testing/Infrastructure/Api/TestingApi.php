<?php

declare(strict_types=1);

namespace App\Testing\Infrastructure\Api;

use App\Testing\Application\CommandInteractor;
use App\Testing\Application\QueryInteractor;

class TestingApi
{
    public function __construct(
        public readonly CommandInteractor $commandInteractor,
        public readonly QueryInteractor $queryInteractor,
    ) {
    }
}
