<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindAnswerOption;

use App\Shared\Application\Query\Query;
use App\Shared\Application\Query\QueryInterface;

class FindAnswerOptionQuery extends Query implements QueryInterface
{
    public function __construct(public readonly string $answerOptionId)
    {
    }
}
