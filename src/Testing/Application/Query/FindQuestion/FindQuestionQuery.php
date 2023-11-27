<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindQuestion;

use App\Shared\Application\Query\Query;

readonly class FindQuestionQuery extends Query
{
    public function __construct(public string $id)
    {
    }
}
