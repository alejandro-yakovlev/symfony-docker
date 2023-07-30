<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\GetPagedSkillGroups;

use App\Shared\Application\Query\Query;
use App\Skills\Domain\Repository\SkillGroupsFilter;

readonly class GetPagedSkillGroupsQuery extends Query
{
    public function __construct(public SkillGroupsFilter $filter)
    {
    }
}
