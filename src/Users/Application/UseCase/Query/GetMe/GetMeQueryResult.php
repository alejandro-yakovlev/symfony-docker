<?php

declare(strict_types=1);

namespace App\Users\Application\UseCase\Query\GetMe;

use App\Users\Application\DTO\UserDTO;

readonly class GetMeQueryResult
{
    public function __construct(public UserDTO $user)
    {
    }
}
