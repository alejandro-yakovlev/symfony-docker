<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroups;

use App\Skills\Application\DTO\SkillGroupDTO;

class FindSkillGroupsQueryResult
{
    /**
     * @param SkillGroupDTO[] $skillGroups
     */
    public function __construct(public readonly array $skillGroups)
    {
    }
}
