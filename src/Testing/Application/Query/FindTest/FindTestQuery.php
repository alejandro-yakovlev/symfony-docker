<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindTest;

use App\Shared\Application\Query\QueryInterface;

class FindTestQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}
