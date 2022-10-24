<?php

declare(strict_types=1);

namespace App\Skills\Infrastructure\Api;

use App\Skills\Application\CommandInteractor;
use App\Skills\Application\QueryInteractor;

class Api
{
    public function __construct(
        public readonly QueryInteractor $queryInteractor,
        public readonly CommandInteractor $commandInteractor,
    ) {
    }
}
