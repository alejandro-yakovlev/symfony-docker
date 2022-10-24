<?php

declare(strict_types=1);

namespace App\Skills\Application\DTO;

use App\Skills\Domain\Entity\Skill\Skill;
use App\Skills\Domain\Entity\Skill\SkillGroup;

class SkillGroupDTO
{
    /**
     * @param string[] $skillsIds
     */
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly array $skillsIds,
    ) {
    }

    public static function fromEntity(SkillGroup $skillGroup): self
    {
        return new self(
            id: $skillGroup->getId(),
            name: $skillGroup->getName(),
            skillsIds: array_map(fn (Skill $skill) => $skill->getId(), $skillGroup->getSkills()->toArray()),
        );
    }
}
