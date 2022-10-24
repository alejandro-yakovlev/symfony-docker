<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkill;

use App\Skills\Application\DTO\SkillDTO;

class FindSkillQueryResult
{
    public function __construct(public readonly ?SkillDTO $skill)
    {
    }
}
