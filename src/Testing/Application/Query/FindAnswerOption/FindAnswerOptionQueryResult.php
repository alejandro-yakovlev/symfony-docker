<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindAnswerOption;

use App\Testing\Application\Query\DTO\Test\AnswerOptionDTO;

readonly class FindAnswerOptionQueryResult
{
    public function __construct(public AnswerOptionDTO $answerOption)
    {
    }
}
