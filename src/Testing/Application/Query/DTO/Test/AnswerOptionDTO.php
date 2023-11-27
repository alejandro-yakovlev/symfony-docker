<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\DTO\Test;

use App\Testing\Domain\Aggregate\Test\AnswerOption;

class AnswerOptionDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $description,
        public readonly bool $isCorrect,
    ) {
    }

    public static function fromEntity(AnswerOption $answerOption): self
    {
        return new self(
            id: $answerOption->getId(),
            description: $answerOption->getDescription(),
            isCorrect: $answerOption->isCorrect(),
        );
    }
}
