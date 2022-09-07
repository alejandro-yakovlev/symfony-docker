<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Testing;

use App\Core\GraphQL\Type\Skills\SkillGQ;
use App\Testing\Application\Query\DTO\Test\QuestionDTO;
use App\Testing\Application\Query\DTO\Test\TestDTO;
use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Type(name: 'TestingTest'),
    GQL\Description('Тест')
]
class TestGQ
{
    #[
        GQL\Field,
        GQL\Description('ID')
    ]
    public readonly string $id;

    #[
        GQL\Field,
        GQL\Description('Название')
    ]
    public readonly string $name;

    #[
        GQL\Field,
        GQL\Description('Описание')
    ]
    public readonly string $description;

    #[
        GQL\Field,
        GQL\Description('Процент правильно отвеченных вопросов')
    ]
    public int $correctAnswersPercentage;

    #[
        GQL\Field,
        GQL\Description('Тест опубликован')
    ]
    public bool $published;

    #[
        GQL\Field(type: '[TestingQuestion]'),
        GQL\Description('Вопросы')
    ]
    public array $questions = [];

    #[
        GQL\Field,
        GQL\Description('Тестируемый навык')
    ]
    public ?SkillGQ $skill = null;

    #[
        GQL\Field(type: 'TestingDifficultyLevel'),
        GQL\Description('Уровень сложности теста')
    ]
    private string $difficultyLevel;

    public function __construct(
        string $id,
        string $name,
        string $description,
        int $correctAnswersPercentage,
        bool $published,
        string $difficultyLevel,
        array $questions
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->correctAnswersPercentage = $correctAnswersPercentage;
        $this->published = $published;
        $this->difficultyLevel = $difficultyLevel;
        $this->questions = $questions;
    }

    public static function fromDTO(TestDTO $testDTO): self
    {
        $questions = array_map(fn (QuestionDTO $qDto) => QuestionGQ::fromDTO($qDto), $testDTO->questions);

        return new self(
            id: $testDTO->id,
            name: $testDTO->name,
            description: $testDTO->description,
            correctAnswersPercentage: $testDTO->correctAnswersPercentage,
            published: $testDTO->isPublished,
            difficultyLevel: $testDTO->difficultyLevel,
            questions: $questions,
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
