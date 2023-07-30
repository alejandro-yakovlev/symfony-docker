<?php

declare(strict_types=1);

namespace App\Skills\Domain\Repository;

use App\Shared\Domain\Repository\Pager;

readonly class SkillsFilter
{
    public function __construct(
        public ?Pager $pager = null,
        public ?string $name = null,
    ) {
    }
}
