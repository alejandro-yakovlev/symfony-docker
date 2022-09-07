<?php

declare(strict_types=1);

namespace App\Testing\Domain\Factory;

use App\Testing\Domain\Entity\Test\Question;
use App\Testing\Domain\Entity\Test\QuestionType;
use App\Testing\Domain\Entity\Test\Test;

class QuestionFactory
{
    public function create(
        string $name,
        string $description,
        QuestionType $type,
        Test $test,
    ): Question {
        return new Question($test, $name, $description, $type);
    }
}
