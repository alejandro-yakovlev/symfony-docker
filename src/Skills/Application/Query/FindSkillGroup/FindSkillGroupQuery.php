<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroup;

use App\Shared\Application\Query\Query;

class FindSkillGroupQuery extends Query
{
    public function __construct(public readonly string $id)
    {
    }
}
