<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkill;

use App\Shared\Application\Query\Query;

class FindSkillQuery extends Query
{
    public function __construct(public readonly string $id)
    {
    }
}
