<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Skills\Skill;

use App\Skills\Application\DTO\SkillGroupInfoDTO;
use Overblog\GraphQLBundle\Annotation as GQL;

#[
    GQL\Type(name: 'SkillGroupInfo'),
    GQL\Description('Информация о группе навыков')
]
class SkillGroupInfoGQ
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

    public static function fromDTO(SkillGroupInfoDTO $skillGroupDTO): self
    {
        return new self(
            id: $skillGroupDTO->id,
            name: $skillGroupDTO->name,
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
