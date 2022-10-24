<?php

declare(strict_types=1);

namespace App\Companies\Domain\Repository;

use App\Shared\Domain\Repository\Pager;

class CompanyFilter
{
    public function __construct(
        public readonly ?Pager $pager = null,
        public readonly ?string $name = null,
    ) {
    }
}
