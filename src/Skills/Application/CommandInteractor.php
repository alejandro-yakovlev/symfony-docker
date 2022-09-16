<?php

declare(strict_types=1);

namespace App\Skills\Application;

use App\Shared\Application\Command\CommandBusInterface;
use App\Skills\Application\Command\ConfirmSpecialistSkill\ConfirmSpecialistSkillCommand;
use App\Skills\Application\Command\CreateSkill\CreateSkillCommand;
use App\Skills\Application\Command\CreateSkillGroup\CreateSkillGroupCommand;

class CommandInteractor
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
    ) {
    }

    public function createSkill(CreateSkillCommand $command): string
    {
        return $this->commandBus->execute($command);
    }

    public function createSkillGroup(CreateSkillGroupCommand $command): string
    {
        return $this->commandBus->execute($command);
    }

    public function confirmSpecialistSkill(ConfirmSpecialistSkillCommand $command): void
    {
        $this->commandBus->execute($command);
    }
}
