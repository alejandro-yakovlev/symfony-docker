<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillById;

use App\Shared\Application\Query\QueryInterface;

class FindSkillByIdQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}
