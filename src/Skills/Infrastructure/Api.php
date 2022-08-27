<?php

namespace App\Skills\Infrastructure;

use App\Shared\Application\Command\CommandBusInterface;
use App\Skills\Application\Command\ConfirmSpecialistSkill\ConfirmSpecialistSkillCommand;

class Api
{
    public function __construct(private readonly CommandBusInterface $commandBus)
    {
    }

    public function confirmSpecialistSkill(
        string $skillId,
        string $globalUserId,
        string $testId,
        int $correctAnswersPercentage
    ): void {
        $this->commandBus->execute(
            new ConfirmSpecialistSkillCommand($skillId, $globalUserId, $testId, $correctAnswersPercentage)
        );
    }
}
