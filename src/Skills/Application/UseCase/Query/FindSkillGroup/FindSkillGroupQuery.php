<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\FindSkillGroup;

use App\Shared\Application\Query\Query;

readonly class FindSkillGroupQuery extends Query
{
    public function __construct(public string $id)
    {
    }
}
