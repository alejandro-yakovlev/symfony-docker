<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateTest;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Entity\ValueObject\GlobalUserId;
use App\Testing\Domain\Entity\Test\DifficultyLevel;
use App\Testing\Domain\Factory\TestFactory;
use App\Testing\Domain\Repository\TestRepositoryInterface;

class CreateTestCommandHandler implements CommandHandlerInterface
{
    public function __construct(private TestRepositoryInterface $testRepository, private TestFactory $testFactory)
    {
    }

    /**
     * @return string Test ID
     */
    public function __invoke(CreateTestCommand $command): string
    {
        $test = $this->testFactory->create(
            GlobalUserId::fromString($command->creatorId),
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
