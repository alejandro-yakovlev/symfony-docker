<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkill;

use App\Shared\Application\Query\QueryInterface;

class FindSkillQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}
