<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Testing;

use App\Testing\Application\Query\DTO\Test\QuestionDTO;
use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Type(name: 'TestingQuestion'),
    GQL\Description('Вопрос теста')
]
class QuestionGQ
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
        GQL\Description('Позиция вопроса')
    ]
    public ?int $positionNumber;

    #[
        GQL\Field,
        GQL\Description('Вопрос опубликован')
    ]
    public bool $published;

    #[
        GQL\Field(type: 'TestingQuestionType'),
        GQL\Description('Тип вопроса')
    ]
    public string $type;

    public function __construct(
        string $id,
        string $name,
        string $description,
        ?int $positionNumber,
        bool $published,
        string $type,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->positionNumber = $positionNumber;
        $this->published = $published;
        $this->type = $type;
    }

    public static function fromDTO(QuestionDTO $dto): self
    {
        return new self(
            id: $dto->id,
            name: $dto->name,
            description: $dto->description,
            positionNumber: $dto->positionNumber,
            published: $dto->published,
            type: $dto->type,
        );
    }
}
