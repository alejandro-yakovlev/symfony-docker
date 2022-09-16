<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroups;

use App\Shared\Application\Query\QueryInterface;
use App\Skills\Domain\Repository\SkillGroupsFilter;

class FindSkillGroupsQuery implements QueryInterface
{
    public function __construct(
        public readonly SkillGroupsFilter $input
    ) {
    }
}
