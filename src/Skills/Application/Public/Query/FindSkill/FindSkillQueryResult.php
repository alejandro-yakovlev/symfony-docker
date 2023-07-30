<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\FindSkill;

use App\Skills\Application\Shared\DTO\Skill\SkillDTO;

class FindSkillQueryResult
{
    public function __construct(public readonly ?SkillDTO $skill)
    {
    }
}
