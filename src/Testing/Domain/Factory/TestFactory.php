<?php

declare(strict_types=1);

namespace App\Testing\Domain\Factory;

use App\Shared\Domain\ValueObject\GlobalUserId;
use App\Testing\Domain\Entity\Test\DifficultyLevel;
use App\Testing\Domain\Entity\Test\Test;

class TestFactory
{
    public function create(
        GlobalUserId $creator,
        string $name,
        string $description,
        DifficultyLevel $difficultyLevel,
        int $correctAnswersPercentage,
        ?string $skillId,
    ): Test {
        $test = new Test($creator, $name, $description, $difficultyLevel);
        $test->setCorrectAnswersPercentage($correctAnswersPercentage);

        if ($skillId) {
            $test->setSkillId($skillId);
        }

        return $test;
    }
}
