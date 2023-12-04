<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase;

use App\Shared\Application\Command\CommandBusInterface;
use App\Skills\Application\UseCase\Command\DeleteSkill\DeleteSkillCommand;

readonly class AdminUseCaseInteractor
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function deleteSkill(string $skillId): void
    {
        $command = new DeleteSkillCommand($skillId);

        $this->commandBus->execute($command);
    }
}
