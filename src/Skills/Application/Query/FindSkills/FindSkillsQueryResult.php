<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkills;

use App\Skills\Application\DTO\SkillDTO;

class FindSkillsQueryResult
{
    /**
     * @param SkillDTO[] $skills
     */
    public function __construct(public readonly array $skills)
    {
    }
}
