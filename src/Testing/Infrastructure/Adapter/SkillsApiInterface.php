<?php

declare(strict_types=1);

namespace App\Testing\Infrastructure\Adapter;

interface SkillsApiInterface
{
    public function confirmSpecialistSkill(
        string $skillId,
        string $userId,
        string $testId,
        int $correctAnswersPercentage
    ): void;
}
