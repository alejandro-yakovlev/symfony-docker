<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroup;

use App\Skills\Application\DTO\SkillGroupDTO;

class FindSkillGroupQueryResult
{
    public function __construct(public readonly ?SkillGroupDTO $skillGroup)
    {
    }
}
