<?php

namespace App\Testing\Infrastructure\Adapter;

readonly class SkillsAdapter
{
    public function __construct(private SkillsApiInterface $api)
    {
    }

    public function confirmSpecialistSkill(
        string $skillId,
        string $userId,
        string $testId,
        int $correctAnswersPercentage
    ): void {
        $this->api->confirmSpecialistSkill($skillId, $userId, $testId, $correctAnswersPercentage);
    }
}
