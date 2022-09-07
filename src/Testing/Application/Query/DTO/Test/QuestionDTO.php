<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\DTO\Test;

use App\Testing\Domain\Entity\Test\AnswerOption;
use App\Testing\Domain\Entity\Test\Question;

class QuestionDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $description,
        public readonly bool $published,
        public readonly string $type,
        public readonly ?int $positionNumber,
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
            name: $question->getName(),
            description: $question->getDescription(),
            published: $question->isPublished(),
            type: $question->getType()->value,
            positionNumber: $question->getPositionNumber(),
            answerOptions: $answerOptions,
        );
    }
}
