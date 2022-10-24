<?php

namespace App\Skills\Application\Command\ConfirmSpecialistSkill;

use App\Shared\Application\Command\Command;

class ConfirmSpecialistSkillCommand extends Command
{
    public function __construct(
        public readonly string $skillId,
        public readonly string $userId,
        public readonly string $testId,
        public readonly int $correctAnswersPercentage,
    ) {
    }
}
