<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateTestingSession;

final readonly class CreateTestingSessionCommand
{
    public function __construct(
        public string $testId,
        public string $userId,
    ) {
    }
}
