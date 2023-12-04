<?php

declare(strict_types=1);

namespace App\Users\Application\UseCase\Query\FindUser;

use App\Users\Application\DTO\UserDTO;

readonly class FindUserQueryResult
{
    public function __construct(public UserDTO $user)
    {
    }
}
