<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateQuestion;

use App\Shared\Application\Command\CommandInterface;

class CreateQuestionCommand implements CommandInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $type,
        public readonly string $testId,
    ) {
    }
}
