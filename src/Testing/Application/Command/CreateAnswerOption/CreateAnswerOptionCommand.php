<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateAnswerOption;

use App\Shared\Application\Command\Command;

class CreateAnswerOptionCommand extends Command
{
    public function __construct(
        public readonly string $questionId,
        public readonly string $description,
        public readonly bool $correct,
    ) {
    }
}
