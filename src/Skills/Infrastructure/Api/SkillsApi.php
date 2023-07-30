<?php

declare(strict_types=1);

namespace App\Skills\Infrastructure\Api;

use App\Skills\Application\Private\PrivateCommandInteractor;
use App\Skills\Application\Public\Command\ConfirmSpecialistSkill\ConfirmSpecialistSkillCommand;
use App\Testing\Infrastructure\Adapter\SkillsApiInterface as TestingSkillsApiInterface;

final readonly class SkillsApi implements TestingSkillsApiInterface
{
    public function __construct(
        private PrivateCommandInteractor $commandInteractor,
    ) {
    }

    public function confirmSpecialistSkill(
        string $skillId,
        string $userId,
        string $testId,
        int $correctAnswersPercentage
    ): void {
        $this->commandInteractor->confirmSpecialistSkill(
            new ConfirmSpecialistSkillCommand(
                $skillId, $userId, $testId, $correctAnswersPercentage
            )
        );
    }
}
