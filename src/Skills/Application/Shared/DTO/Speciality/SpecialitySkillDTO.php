<?php

declare(strict_types=1);

namespace App\Skills\Application\Shared\DTO\Speciality;

use App\Skills\Application\Shared\DTO\Skill\SkillDTO;

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
