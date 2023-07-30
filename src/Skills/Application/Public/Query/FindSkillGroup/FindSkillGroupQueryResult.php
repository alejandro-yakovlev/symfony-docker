<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\FindSkillGroup;

use App\Skills\Application\Shared\DTO\SkillGroup\SkillGroupDTO;

readonly class FindSkillGroupQueryResult
{
    public function __construct(public ?SkillGroupDTO $skillGroup)
    {
    }
}
