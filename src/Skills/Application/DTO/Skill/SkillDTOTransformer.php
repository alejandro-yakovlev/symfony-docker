<?php

declare(strict_types=1);

namespace App\Skills\Application\DTO\Skill;

use App\Skills\Application\DTO\SkillGroup\SkillGroupDTO;
use App\Skills\Domain\Aggregate\Skill\Skill;

class SkillDTOTransformer
{
    /**
     * @param Skill[] $entities
     *
     * @return SkillDTO[]
     */
    public function fromSkillEntityList(array $entities): array
    {
        /** @var SkillDTO[] $skills */
        $skills = [];
        foreach ($entities as $entity) {
            $skills[] = $this->fromSkillEntity($entity);
        }

        return $skills;
    }

    public function fromSkillEntity(Skill $skill): SkillDTO
    {
        $dto = new SkillDTO();
        $dto->id = $skill->getId();
        $dto->name = $skill->getName();

        $skillGroup = new SkillGroupDTO();
        $skillGroup->id = $skill->getSkillGroup()->getId();
        $skillGroup->name = $skill->getSkillGroup()->getName();
        $dto->skillGroup = $skillGroup;

        return $dto;
    }
}
