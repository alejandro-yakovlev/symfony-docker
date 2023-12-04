<?php

declare(strict_types=1);

namespace App\Skills\Application\DTO\Speciality;

use App\Skills\Application\DTO\Skill\SkillDTO;

readonly class SpecialitySkillDTO
{
    public function __construct(
        public string $id,
        public string $specialityId,
        public SkillDTO $skill,
        public string $level
    ) {
    }
}
