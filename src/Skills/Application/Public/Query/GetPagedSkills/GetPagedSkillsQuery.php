<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\GetPagedSkills;

use App\Shared\Application\Query\Query;
use App\Shared\Domain\Repository\Pager;

readonly class GetPagedSkillsQuery extends Query
{
    public function __construct(public Pager $pager)
    {
    }
}
