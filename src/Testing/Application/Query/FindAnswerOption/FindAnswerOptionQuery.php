<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindAnswerOption;

use App\Shared\Application\Query\Query;

readonly class FindAnswerOptionQuery extends Query
{
    public function __construct(public string $answerOptionId)
    {
    }
}
