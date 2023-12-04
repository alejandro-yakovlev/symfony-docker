<?php

declare(strict_types=1);

namespace App\Skills\Infrastructure\Api;

use App\Skills\Application\UseCase\Command\ConfirmSpecialistSkill\ConfirmSpecialistSkillCommand;
use App\Skills\Application\UseCase\PrivateUseCaseInteractor;
use App\Testing\Infrastructure\Adapter\SkillsApiInterface as TestingSkillsApiInterface;

final readonly class SkillsApi implements TestingSkillsApiInterface
{
    public function __construct(
        private PrivateUseCaseInteractor $commandInteractor,
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
