<?php

declare(strict_types=1);

namespace App\Testing\Domain\Factory;

use App\Shared\Domain\Entity\ValueObject\UserUlid;
use App\Testing\Domain\Entity\Test\DifficultyLevel;
use App\Testing\Domain\Entity\Test\Test;
use App\Testing\Domain\Specification\TestSpecification;

class TestFactory
{
    public function __construct(private TestSpecification $testSpecification)
    {
    }

    public function create(
        UserUlid $creator,
        string $name,
        string $description,
        DifficultyLevel $difficultyLevel,
        int $correctAnswersPercentage,
        ?string $skillId,
    ): Test {
        $test = new Test($creator, $name, $description, $difficultyLevel, $this->testSpecification);
        $test->setCorrectAnswersPercentage($correctAnswersPercentage);

        if ($skillId) {
            $test->setSkillId($skillId);
        }

        return $test;
    }
}
