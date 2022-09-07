<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindQuestionById;

use App\Shared\Application\Query\QueryInterface;

class FindQuestionByIdQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}
