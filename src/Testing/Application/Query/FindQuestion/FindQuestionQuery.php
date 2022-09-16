<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindQuestion;

use App\Shared\Application\Query\QueryInterface;

class FindQuestionQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}
