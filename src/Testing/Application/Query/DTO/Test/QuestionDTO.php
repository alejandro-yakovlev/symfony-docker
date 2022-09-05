<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\DTO\Test;

use App\Testing\Domain\Entity\Test\AnswerOption;
use App\Testing\Domain\Entity\Test\Question;

class QuestionDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $description,
        public readonly string $type,
        public readonly int $positionNumber,
        public readonly array $answerOptions,
    ) {
    }

    public static function fromEntity(Question $question)
    {
        $answerOptions = array_map(
            fn (AnswerOption $a) => AnswerOptionDTO::fromEntity($a),
            $question->getAnswerOptions()->toArray()
        );

        return new self(
            id: $question->getId(),
            description: $question->getDescription(),
            type: $question->getType()->value,
            positionNumber: $question->getPositionNumber(),
            answerOptions: $answerOptions,
        );
    }
}
