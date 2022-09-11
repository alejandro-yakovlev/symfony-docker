<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Skills;

use App\Skills\Application\DTO\SkillDTO;
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

    /**
     * @var SkillGQ[]
     */
    #[
        GQL\Field(type: '[Skill]'),
        GQL\Description('Навыки группы'),
        GQL\Arg(name: 'limit', type: 'Int!', default: 10)
    ]
    public array $skills = [];

    /**
     * @param SkillGQ[] $skills
     */
    public function __construct(string $id, string $name, array $skills)
    {
        $this->id = $id;
        $this->name = $name;
        $this->skills = $skills;
    }

    public static function fromDTO(SkillGroupDTO $skillGroupDTO): self
    {
        $skills = array_map(fn(SkillDTO $dto) => SkillGQ::fromDTO($dto), $skillGroupDTO->skills);

        return new self(
            id: $skillGroupDTO->id,
            name: $skillGroupDTO->name,
            skills: $skills,
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

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @param SkillGQ[] $skills
     */
    public function setSkills(array $skills): void
    {
        $this->skills = $skills;
    }
}
