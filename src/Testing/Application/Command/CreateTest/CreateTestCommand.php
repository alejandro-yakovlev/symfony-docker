<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateTest;

use App\Shared\Application\Command\Command;

readonly class CreateTestCommand extends Command
{
    public function __construct(
        public string $ownerId,
        public string $name,
        public string $description,
        public string $difficultyLevel,
        public int $correctAnswersPercentage,
        public ?string $skillId,
    ) {
    }
}
