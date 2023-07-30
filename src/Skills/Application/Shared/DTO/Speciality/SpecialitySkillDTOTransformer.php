<?php

declare(strict_types=1);

namespace App\Skills\Application\Shared\DTO\Speciality;

use App\Skills\Application\Shared\DTO\Skill\SkillDTOTransformer;
use App\Skills\Domain\Aggregate\Speciality\SpecialitySkill;

readonly class SpecialitySkillDTOTransformer
{
    public function __construct(
        private SkillDTOTransformer $skillDTOTransformer,
    ) {
    }

    public function fromEntity(SpecialitySkill $specialitySkill): SpecialitySkillDTO
    {
        $skillDTO = $this->skillDTOTransformer->fromSkillEntity($specialitySkill->getSkill());

        return new SpecialitySkillDTO(
            id: $specialitySkill->getId(),
            specialityId: $specialitySkill->getId(),
            skill: $skillDTO,
            level: $specialitySkill->getLevel()->value,
        );
    }
}
