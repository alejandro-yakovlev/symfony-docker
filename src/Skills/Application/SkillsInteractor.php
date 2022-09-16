<?php

declare(strict_types=1);

namespace App\Skills\Application;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Skills\Application\Command\ConfirmSpecialistSkill\ConfirmSpecialistSkillCommand;
use App\Skills\Application\Command\CreateSkill\CreateSkillCommand;
use App\Skills\Application\Command\CreateSkillGroup\CreateSkillGroupCommand;

final class SkillsInteractor
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly CommandBusInterface $commandBus,
    ) {
    }

    // ////////////
    // COMMANDS //
    // ////////////

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
