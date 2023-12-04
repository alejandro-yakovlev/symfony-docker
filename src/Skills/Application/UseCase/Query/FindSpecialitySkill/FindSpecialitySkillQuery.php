<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\FindSpecialitySkill;

use App\Shared\Application\Query\Query;

readonly class FindSpecialitySkillQuery extends Query
{
    public function __construct(public string $id)
    {
    }
}
