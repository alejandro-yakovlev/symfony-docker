<?php

declare(strict_types=1);

namespace App\Users\Application\Public\Query\FindUser;

use App\Shared\Application\Query\Query;

readonly class FindUserQuery extends Query
{
    public function __construct(public string $userId)
    {
    }
}
