<?php

declare(strict_types=1);

namespace App\Testing\Domain\Factory;

use App\Testing\Domain\Aggregate\Test\DifficultyLevel;
use App\Testing\Domain\Aggregate\Test\Test;
use App\Testing\Domain\Specification\TestSpecification;

class TestFactory
{
    public function __construct(private TestSpecification $testSpecification)
    {
    }

    public function create(
        string $ownerId,
        string $name,
        string $description,
        DifficultyLevel $difficultyLevel,
        int $correctAnswersPercentage,
        ?string $skillId,
    ): Test {
        $test = new Test($name, $description, $difficultyLevel, $ownerId, $this->testSpecification);
        $test->setCorrectAnswersPercentage($correctAnswersPercentage);

        if ($skillId) {
            $test->setSkillId($skillId);
        }

        return $test;
    }
}
