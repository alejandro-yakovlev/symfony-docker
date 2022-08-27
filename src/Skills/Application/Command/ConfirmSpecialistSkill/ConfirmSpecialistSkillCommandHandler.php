<?php

namespace App\Skills\Application\Command\ConfirmSpecialistSkill;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Skills\Domain\Service\SkillConfirmationService;

class ConfirmSpecialistSkillCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly SkillConfirmationService $skillConfirmationService
    ) {
    }

    public function __invoke(ConfirmSpecialistSkillCommand $command): void
    {
        $this->skillConfirmationService->confirm($command->globalUserId, $command->skillId, $command->testId, $command->correctAnswersPercentage);
    }
}
