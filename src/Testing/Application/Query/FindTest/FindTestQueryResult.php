<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindTest;

use App\Shared\Application\Query\QueryInterface;
use App\Testing\Application\Query\DTO\Test\TestDTO;

class FindTestQueryResult implements QueryInterface
{
    public function __construct(
        public readonly ?TestDTO $test,
    ) {
    }
}
