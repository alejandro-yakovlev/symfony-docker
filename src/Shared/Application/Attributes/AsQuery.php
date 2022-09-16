<?php

declare(strict_types=1);

namespace App\Shared\Application\Attributes;

#[\Attribute]
class AsQuery
{
    public function __construct(
        public string $result
    ) {
    }
}
