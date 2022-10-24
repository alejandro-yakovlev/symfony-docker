<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateTest;

use App\Shared\Application\Command\Command;

class CreateTestCommand extends Command
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $difficultyLevel,
        public readonly int $correctAnswersPercentage,
        public readonly ?string $skillId,
    ) {
    }
}
