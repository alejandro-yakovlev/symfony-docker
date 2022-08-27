<?php

namespace App\Testing\Infrastructure\Adapter;

use App\Skills\Infrastructure\Api;

class SkillsAdapter
{
    public function __construct(private readonly Api $api)
    {
    }

    public function confirmSpecialistSkill(string $skillId, string $userId, string $testId, int $correctAnswersPercentage): void
    {
        $this->api->confirmSpecialistSkill($skillId, $userId, $testId, $correctAnswersPercentage);
    }
}
