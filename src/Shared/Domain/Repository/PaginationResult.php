<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository;

readonly class PaginationResult
{
    public function __construct(public array $items, public int $total)
    {
    }
}
