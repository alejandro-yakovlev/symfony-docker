<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Skills\SkillGroup;

use App\Skills\Application\DTO\SkillGroupDTO;
use App\Skills\Application\DTO\SkillInfoDTO;
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
     * @var SkillInfoGQ[]
     */
    #[
        GQL\Field(
            type: '[SkillInfo]',
            resolve: "@=query('skillsResolver', args.limit, info, context, value)"
        ),
        GQL\Description('Навыки группы'),
        GQL\Arg(name: 'limit', type: 'Int!', default: 10)
    ]
    public array $skills;

    /**
     * @param SkillInfoGQ[] $skills
     */
    public function __construct(string $id, string $name, array $skills)
    {
        $this->id = $id;
        $this->name = $name;
        $this->skills = $skills;
    }

    public static function fromDTO(SkillGroupDTO $skillGroupDTO): self
    {
        return new self(
            id: $skillGroupDTO->id,
            name: $skillGroupDTO->name,
            skills: array_map(fn (SkillInfoDTO $dto) => SkillInfoGQ::fromDTO($dto), $skillGroupDTO->skills),
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
}
