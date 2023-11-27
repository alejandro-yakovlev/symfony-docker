<?php

declare(strict_types=1);

namespace App\Testing\Domain\Factory;

use App\Testing\Domain\Aggregate\Test\AnswerOption;
use App\Testing\Domain\Aggregate\Test\Question;

class AnswerOptionFactory
{
    public function create(Question $question, string $description, bool $isCorrect): AnswerOption
    {
        return new AnswerOption($question, $description, $isCorrect);
    }
}
