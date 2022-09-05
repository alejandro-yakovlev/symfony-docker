<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Testing;

use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Enum(name: 'DifficultyLevelEnum'),
    GQL\Description('Уровень сложности теста')
]
final class DifficultyLevelEnumGQ
{
    #[GQL\Description('Легкий')]
    public const EASY = 'easy';

    #[GQL\Description('Средний')]
    public const MEDIUM = 'medium';

    #[GQL\Description('Сложный')]
    public const HARD = 'hard';

    public static function from(string $difficultyLevel)
    {
    }
}
