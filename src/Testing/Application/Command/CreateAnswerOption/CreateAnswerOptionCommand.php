<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateAnswerOption;

use App\Shared\Application\Command\CommandInterface;

class CreateAnswerOptionCommand implements CommandInterface
{
    public function __construct(
        public readonly string $questionId,
        public readonly string $description,
        public readonly bool $isCorrect,
    ) {
    }
}
