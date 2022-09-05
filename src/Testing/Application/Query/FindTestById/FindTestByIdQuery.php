<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindTestById;

use App\Shared\Application\Query\QueryInterface;

class FindTestByIdQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}
