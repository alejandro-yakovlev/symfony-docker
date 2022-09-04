<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroups;

use App\Shared\Application\Query\QueryInterface;

class FindSkillGroupsQuery implements QueryInterface
{
    public function __construct(public readonly string $name)
    {
    }
}
