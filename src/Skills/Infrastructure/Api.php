<?php

namespace App\Skills\Infrastructure;

use App\Shared\Application\Command\CommandBusInterface;
use App\Skills\Application\Command\ConfirmSpecialistSkill\ConfirmSpecialistSkillCommand;
use App\Skills\Application\CommandInteractor;
use App\Skills\Application\QueryInteractor;

class Api
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        public readonly QueryInteractor $queryInteractor,
        public readonly CommandInteractor $commandInteractor
    ) {
    }

    public function confirmSpecialistSkill(
        string $skillId,
        string $userId,
        string $testId,
        int $correctAnswersPercentage
    ): void {
        $this->commandBus->execute(
            new ConfirmSpecialistSkillCommand($skillId, $userId, $testId, $correctAnswersPercentage)
        );
    }
}
