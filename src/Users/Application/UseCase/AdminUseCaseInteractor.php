<?php

declare(strict_types=1);

namespace App\Users\Application\UseCase;

use App\Shared\Application\Command\CommandBusInterface;
use App\Users\Application\UseCase\Command\CreateUser\CreateUserCommand;

readonly class AdminUseCaseInteractor
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function createUser(CreateUserCommand $command): void
    {
        $this->commandBus->execute($command);
    }
}
