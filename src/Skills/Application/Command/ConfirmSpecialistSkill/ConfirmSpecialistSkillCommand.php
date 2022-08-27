<?php

namespace App\Skills\Application\Command\ConfirmSpecialistSkill;

use App\Shared\Application\Command\CommandInterface;

class ConfirmSpecialistSkillCommand implements CommandInterface
{
    public function __construct(
        public readonly string $skillId,
        public readonly string $globalUserId,
        public readonly string $testId,
        public readonly int $correctAnswersPercentage,
    ) {
    }
}
