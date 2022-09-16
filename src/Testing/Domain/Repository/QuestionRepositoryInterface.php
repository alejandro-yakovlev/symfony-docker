<?php

declare(strict_types=1);

namespace App\Testing\Domain\Repository;

use App\Testing\Domain\Entity\Test\Question;

interface QuestionRepositoryInterface
{
    public function findOneById(string $id): ?Question;
}