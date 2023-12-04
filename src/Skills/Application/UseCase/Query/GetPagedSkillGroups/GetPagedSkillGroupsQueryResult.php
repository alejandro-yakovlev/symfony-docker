<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetPagedSkillGroups;

use App\Shared\Domain\Repository\Pager;
use App\Skills\Application\DTO\SkillGroup\SkillGroupDTO;

class GetPagedSkillGroupsQueryResult
{
    /**
     * @param SkillGroupDTO[] $skillGroups
     */
    public function __construct(public readonly array $skillGroups, public readonly Pager $pager)
    {
    }
}
