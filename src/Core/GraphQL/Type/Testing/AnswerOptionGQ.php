<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Testing;

use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Type(name: 'TestingAnswerOption'),
    GQL\Description('Вариант ответа на вопрос')
]
class AnswerOptionGQ
{
    #[
        GQL\Field,
        GQL\Description('ID')
    ]
    public readonly string $id;

    #[
        GQL\Field,
        GQL\Description('Описание')
    ]
    public readonly string $description;

    #[
        GQL\Field,
        GQL\Description('Является верным')
    ]
    public readonly bool $isCorrect;

    public function __construct(string $id, string $description, bool $isCorrect)
    {
        $this->id = $id;
        $this->description = $description;
        $this->isCorrect = $isCorrect;
    }
}
