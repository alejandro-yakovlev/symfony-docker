<?php

declare(strict_types=1);

namespace App\Skills\Domain\Repository;

use App\Shared\Domain\Repository\PaginationInput;

class SkillGroupsFilter
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?PaginationInput $paginationInput = null,
    ) {
    }
}
