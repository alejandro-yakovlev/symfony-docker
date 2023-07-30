<?php

declare(strict_types=1);

namespace App\Skills\Domain\Repository;

use App\Shared\Domain\Repository\Pager;

class SkillGroupsFilter
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?Pager $pager = null,
    ) {
    }
}
