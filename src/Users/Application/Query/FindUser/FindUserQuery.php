<?php

declare(strict_types=1);

namespace App\Users\Application\Query\FindUser;

use App\Shared\Application\Query\Query;

class FindUserQuery extends Query
{
    private function __construct(
        public readonly ?string $id,
    ) {
    }

    public static function fromId(?string $id): self
    {
        return new self(id: $id);
    }
}
