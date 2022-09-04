<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroupById;

use App\Shared\Application\Query\QueryInterface;

class FindSkillGroupByIdQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}
