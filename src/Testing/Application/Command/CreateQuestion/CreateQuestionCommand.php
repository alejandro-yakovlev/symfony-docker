<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateQuestion;

use App\Shared\Application\Command\Command;

readonly class CreateQuestionCommand extends Command
{
    public function __construct(
        public string $name,
        public string $description,
        public string $type,
        public string $testId,
    ) {
    }
}
