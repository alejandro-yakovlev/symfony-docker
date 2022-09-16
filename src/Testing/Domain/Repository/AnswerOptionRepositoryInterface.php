<?php

declare(strict_types=1);

namespace App\Testing\Domain\Repository;

use App\Testing\Domain\Entity\Test\AnswerOption;

interface AnswerOptionRepositoryInterface
{
    public function add(AnswerOption $entity): void;

    public function findOneById(string $answerOptionId): ?AnswerOption;
}