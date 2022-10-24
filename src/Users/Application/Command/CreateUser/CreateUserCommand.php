<?php

declare(strict_types=1);

namespace App\Users\Application\Command\CreateUser;

use App\Shared\Application\Command\Command;

class CreateUserCommand extends Command
{
    public function __construct(public readonly string $email, public readonly string $password)
    {
    }
}
