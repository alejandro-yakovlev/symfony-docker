<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Skills\SkillGroup;

use App\Skills\Application\DTO\SkillInfoDTO;
use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Type(name: 'SkillInfo'),
    GQL\Description('Навык')
]
class SkillInfoGQ
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

    public static function fromDTO(SkillInfoDTO $dto): self
    {
        return new self(
            id: $dto->id,
            name: $dto->name,
        );
    }
}
