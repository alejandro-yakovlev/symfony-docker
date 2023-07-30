<?php

declare(strict_types=1);

namespace App\Skills\Application\Shared\DTO\Skill;

use App\Skills\Application\Shared\DTO\SkillGroup\SkillGroupDTO;

class SkillDTO
{
    public string $id;
    public string $name;
    public SkillGroupDTO $skillGroup;
}
