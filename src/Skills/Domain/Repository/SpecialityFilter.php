<?php

declare(strict_types=1);

namespace App\Skills\Domain\Repository;

use App\Shared\Domain\Repository\Pager;

class SpecialityFilter
{
    /**
     * @param string[] $publicationStatuses
     */
    public function __construct(
        public ?Pager $pager = null,
        public ?array $publicationStatuses = null,
        public ?string $name = null,
        public ?string $id = null,
        public ?string $ownerId = null,
    ) {
    }
}
