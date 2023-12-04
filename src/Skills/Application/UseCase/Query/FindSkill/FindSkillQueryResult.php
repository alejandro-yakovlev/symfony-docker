<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\FindSkill;

use App\Skills\Application\DTO\Skill\SkillDTO;

class FindSkillQueryResult
{
    public function __construct(public readonly ?SkillDTO $skill)
    {
    }
}
