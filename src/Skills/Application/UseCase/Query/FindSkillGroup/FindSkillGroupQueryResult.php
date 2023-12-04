<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\FindSkillGroup;

use App\Skills\Application\DTO\SkillGroup\SkillGroupDTO;

readonly class FindSkillGroupQueryResult
{
    public function __construct(public ?SkillGroupDTO $skillGroup)
    {
    }
}
