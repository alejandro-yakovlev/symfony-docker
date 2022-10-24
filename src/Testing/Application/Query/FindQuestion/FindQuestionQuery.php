<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindQuestion;

use App\Shared\Application\Query\Query;
use App\Shared\Application\Query\QueryInterface;

class FindQuestionQuery extends Query implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}
