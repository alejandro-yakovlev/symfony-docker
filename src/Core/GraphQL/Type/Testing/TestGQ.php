<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Testing;

use App\Core\GraphQL\Type\Skills\SkillGQ;
use App\Testing\Application\Query\DTO\Test\TestDTO;
use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Type(name: 'Test'),
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
        GQL\Field,
        GQL\Description('Тестируемый навык')
    ]
    public ?SkillGQ $skill = null;

    #[
        GQL\Field(type: 'DifficultyLevelEnum'),
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
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->correctAnswersPercentage = $correctAnswersPercentage;
        $this->published = $published;
        $this->difficultyLevel = $difficultyLevel;
    }

    public static function fromDTO(TestDTO $dto): self
    {
        return new self(
            id: $dto->id,
            name: $dto->name,
            description: $dto->description,
            correctAnswersPercentage: $dto->correctAnswersPercentage,
            published: $dto->isPublished,
            difficultyLevel: $dto->difficultyLevel,
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
