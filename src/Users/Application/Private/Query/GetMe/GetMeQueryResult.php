<?php

declare(strict_types=1);

namespace App\Users\Application\Private\Query\GetMe;

use App\Users\Application\Shared\DTO\UserDTO;

readonly class GetMeQueryResult
{
    public function __construct(public UserDTO $user)
    {
    }
}
