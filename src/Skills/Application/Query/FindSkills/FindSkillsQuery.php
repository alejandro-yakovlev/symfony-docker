<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkills;

use App\Shared\Application\Query\Query;

class FindSkillsQuery extends Query
{
    /**
     * @param string[] $ids
     */
    public function __construct(public readonly array $ids)
    {
    }
}
