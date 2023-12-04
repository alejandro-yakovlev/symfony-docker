<?php

namespace App\Testing\Application\Query\DTO;

use App\Testing\Domain\Aggregate\TestingSession\TestingSession;

readonly class TestingSessionDTO
{
    public function __construct(
        public string $id,
        public string $userId,
        public string $testId,
        public int $correctAnswersPercentage,
        public ?string $skillId
    ) {
    }

    public static function fromEntity(TestingSession $testingSession): self
    {
        return new self(
            $testingSession->getId(),
            $testingSession->getUserId(),
            $testingSession->getTest()->getId(),
            $testingSession->getCorrectAnswersPercentage(),
            $testingSession->getTest()->getSkillId()
        );
    }
}
