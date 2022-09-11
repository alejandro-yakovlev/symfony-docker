<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Testing;

use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Enum(name: 'TestingDifficultyLevel'),
    GQL\Description('Уровень сложности теста')
]
final class DifficultyLevelGQ
{
    #[GQL\Description('Легкий')]
    public const EASY = 'easy';

    #[GQL\Description('Средний')]
    public const MEDIUM = 'medium';

    #[GQL\Description('Сложный')]
    public const HARD = 'hard';
}
