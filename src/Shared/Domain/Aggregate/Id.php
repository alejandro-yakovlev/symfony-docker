<?php

namespace App\Shared\Domain\Aggregate;

use App\Shared\Domain\Service\UlidService;

class Id
{
    public static function makeUlid(): string
    {
        return UlidService::generate();
    }
}
