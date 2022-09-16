<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroup;

use App\Shared\Application\Query\QueryInterface;

class FindSkillGroupQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}
