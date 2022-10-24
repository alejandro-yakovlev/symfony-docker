<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository;

class PaginationResult
{
    public function __construct(public readonly array $items, public readonly int $total)
    {
    }
}
