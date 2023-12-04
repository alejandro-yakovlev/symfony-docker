<?php

declare(strict_types=1);

namespace App\Users\Application\UseCase\Query\FindUserByEmail;

use App\Shared\Application\Query\QueryInterface;

readonly class FindUserByEmailQuery implements QueryInterface
{
    public function __construct(public string $email)
    {
    }
}
