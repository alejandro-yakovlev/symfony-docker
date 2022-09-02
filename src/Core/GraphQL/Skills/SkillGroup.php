<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Skills;

use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Type,
    GQL\Description('Группа навыков')
]
class SkillGroup
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

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function toArray(): array
    {
        return [];
    }
}
