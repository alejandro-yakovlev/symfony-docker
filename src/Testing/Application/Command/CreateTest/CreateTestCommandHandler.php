<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateTest;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Testing\Domain\Aggregate\Test\DifficultyLevel;
use App\Testing\Domain\Factory\TestFactory;
use App\Testing\Domain\Repository\TestRepositoryInterface;

readonly class CreateTestCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TestRepositoryInterface $testRepository,
        private TestFactory $testFactory
    ) {
    }

    /**
     * @return string Test ID
     */
    public function __invoke(CreateTestCommand $command): string
    {
        $test = $this->testFactory->create(
            $command->ownerId,
            $command->name,
            $command->description,
            DifficultyLevel::from($command->difficultyLevel),
            $command->correctAnswersPercentage,
            $command->skillId,
        );
        $this->testRepository->add($test);

        return $test->getId();
    }
}
