<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindAnswerOption;

use App\Testing\Application\Query\DTO\Test\AnswerOptionDTO;

class FindAnswerOptionQueryResult
{
    public function __construct(public readonly AnswerOptionDTO $answerOption)
    {
    }
}
