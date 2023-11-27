<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateAnswerOption;

use App\Shared\Application\Command\Command;

readonly class CreateAnswerOptionCommand extends Command
{
    public function __construct(
        public string $questionId,
        public string $description,
        public bool $correct,
    ) {
    }
}
