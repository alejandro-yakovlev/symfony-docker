<?php

declare(strict_types=1);

namespace App\Skills\Application\DTO;

use App\Skills\Domain\Entity\Skill\Skill;

class SkillDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $skillGroupId,
    ) {
    }

    public static function fromEntity(Skill $skill): self
    {
        return new self(
            id: $skill->getId(),
            name: $skill->getName(),
            skillGroupId: $skill->getSkillGroup()->getId(),
        );
    }
}
