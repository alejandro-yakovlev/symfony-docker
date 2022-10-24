<?php

declare(strict_types=1);

namespace App\Users\Application\Query\FindUserByEmail;

use App\Shared\Application\Query\Query;

class FindUserByEmailQuery extends Query
{
    public function __construct(public readonly string $email)
    {
    }
}
