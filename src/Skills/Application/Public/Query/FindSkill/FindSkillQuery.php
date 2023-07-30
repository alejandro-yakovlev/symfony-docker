<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\FindSkill;

use App\Shared\Application\Query\Query;

readonly class FindSkillQuery extends Query
{
    public function __construct(public string $id)
    {
    }
}
