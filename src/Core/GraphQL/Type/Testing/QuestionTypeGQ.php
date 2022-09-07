<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Testing;

use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Enum(name: 'TestingQuestionType'),
    GQL\Description('Уровень сложности теста')
]
final class QuestionTypeGQ
{
    #[GQL\Description('Один ответ из списка')]
    public const MULTIPLE_CHOICE = 'multiple_choice';

    #[GQL\Description('Несколько ответов из списка')]
    public const MULTIPLE_RESPONSE = 'multiple_response';
}
