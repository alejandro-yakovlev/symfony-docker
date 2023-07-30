<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\GetPagedSkillGroups;

use App\Shared\Domain\Repository\Pager;
use App\Skills\Application\Shared\DTO\SkillGroup\SkillGroupDTO;

class GetPagedSkillGroupsQueryResult
{
    /**
     * @param SkillGroupDTO[] $skillGroups
     */
    public function __construct(public readonly array $skillGroups, public readonly Pager $pager)
    {
    }
}
