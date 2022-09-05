<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateTest;

use App\Shared\Application\Command\CommandInterface;

class CreateTestCommand implements CommandInterface
{
    public function __construct(
        public readonly string $creatorId,
        public readonly string $name,
        public readonly string $description,
        public readonly string $difficultyLevel,
        public readonly int $correctAnswersPercentage,
        public readonly ?string $skillId,
    ) {
    }
}
