<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Skills;

use App\Skills\Application\DTO\SkillGroupDTO;
use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Type(name: 'SkillGroup'),
    GQL\Description('Группа навыков')
]
class SkillGroupGQ
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

    public static function fromDTO(SkillGroupDTO $skillGroupDTO): self
    {
        return new self(
            id: $skillGroupDTO->id,
            name: $skillGroupDTO->name,
        );
    }

    /**
     * @param SkillGroupDTO[] $dtos
     *
     * @return SkillGroupGQ[]
     */
    public static function fromDTOCollection(array $dtos): array
    {
        return array_map(fn (SkillGroupDTO $dto) => self::fromDTO($dto), $dtos);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
