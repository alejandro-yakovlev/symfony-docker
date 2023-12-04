<?php

declare(strict_types=1);

namespace App\Testing\Domain\Repository;

use App\Testing\Domain\Aggregate\Test\Question;

interface QuestionRepositoryInterface
{
    public function add(Question $entity): void;

    public function findOneById(string $id): ?Question;
}
