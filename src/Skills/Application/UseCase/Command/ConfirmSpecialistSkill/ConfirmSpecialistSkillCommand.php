<?php

namespace App\Skills\Application\UseCase\Command\ConfirmSpecialistSkill;

use App\Shared\Application\Command\Command;

readonly class ConfirmSpecialistSkillCommand extends Command
{
    public function __construct(
        public string $skillId,
        public string $userId,
        public string $testId,
        public int $correctAnswersPercentage,
    ) {
    }
}
