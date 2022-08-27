<?php

namespace App\Testing\Application\Query\DTO;

use App\Testing\Domain\Entity\TestingSession\TestingSession;

class TestingSessionDTO
{
    public function __construct(
        public readonly string $id,
        public readonly ?string $skillId,
    ) {
    }

    public static function fromEntity(TestingSession $testingSession): self
    {
        return new self(
            $testingSession->getId(),
            $testingSession->getTest()->getSkillId(),
        );
    }
}
