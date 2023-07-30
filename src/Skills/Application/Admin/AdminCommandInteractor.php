<?php

declare(strict_types=1);

namespace App\Skills\Application\Admin;

use App\Shared\Application\Command\CommandBusInterface;
use App\Skills\Application\Admin\Command\DeleteSkill\DeleteSkillCommand;

readonly class AdminCommandInteractor
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
