<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Skills\Skill;

use App\Skills\Application\DTO\SkillDTO;
use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Type(name: 'Skill'),
    GQL\Description('Навык')
]
class SkillGQ
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
        GQL\Field(type: 'SkillGroupInfo'),
        GQL\Description('Группа навыков')
    ]
    public readonly SkillGroupInfoGQ $skillGroupGQ;

    public function __construct(string $id, string $name, SkillGroupInfoGQ $skillGroupGQ)
    {
        $this->id = $id;
        $this->name = $name;
        $this->skillGroupGQ = $skillGroupGQ;
    }

    public static function fromDTO(SkillDTO $dto): self
    {
        return new self(
            id: $dto->id,
            name: $dto->name,
            skillGroupGQ: SkillGroupInfoGQ::fromDTO($dto->skillGroup),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
