<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindQuestion;

use App\Testing\Application\Query\DTO\Test\QuestionDTO;

class FindQuestionQueryResult
{
    public function __construct(public readonly QuestionDTO $question)
    {
    }
}
