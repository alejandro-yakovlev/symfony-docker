<?php

declare(strict_types=1);

namespace App\Users\Application\Command\CreateUser;

use App\Shared\Application\Command\CommandInterface;

class CreateUserCommand implements CommandInterface
{
    public function __construct(public readonly string $email, public readonly string $password)
    {
    }
}
