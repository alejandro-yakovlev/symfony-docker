<?php

declare(strict_types=1);

namespace App\Users\Application\Public\Query\FindUser;

use App\Users\Application\Shared\DTO\UserDTO;

readonly class FindUserQueryResult
{
    public function __construct(public UserDTO $user)
    {
    }
}
