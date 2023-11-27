<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindTest;

use App\Shared\Application\Query\Query;
use App\Shared\Application\Query\QueryInterface;
use App\Testing\Application\Query\DTO\Test\TestDTO;

readonly class FindTestQueryResult extends Query implements QueryInterface
{
    public function __construct(
        public ?TestDTO $test,
    ) {
    }
}
