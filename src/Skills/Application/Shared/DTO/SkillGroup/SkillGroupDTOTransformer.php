<?php

declare(strict_types=1);

namespace App\Skills\Application\Shared\DTO\SkillGroup;

use App\Skills\Domain\Aggregate\Skill\SkillGroup;

class SkillGroupDTOTransformer
{
    public function fromEntity(SkillGroup $entity): object
    {
        $dto = new SkillGroupDTO();
        $dto->id = $entity->getId();
        $dto->name = $entity->getName();

        return $dto;
    }

    /**
     * @param array<SkillGroup> $skillGroups
     *
     * @return array<SkillGroupDTO>
     */
    public function fromEntityList(array $skillGroups): array
    {
        $skillGroupDTOs = [];
        foreach ($skillGroups as $skillGroup) {
            $skillGroupDTOs[] = $this->fromEntity($skillGroup);
        }

        return $skillGroupDTOs;
    }
}
