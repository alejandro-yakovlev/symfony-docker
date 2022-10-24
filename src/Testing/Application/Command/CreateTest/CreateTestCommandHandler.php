<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateTest;

use App\Auth\AuthUserFetcher\AuthUserFetcherInterface;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Entity\ValueObject\UserUlid;
use App\Testing\Domain\Entity\Test\DifficultyLevel;
use App\Testing\Domain\Factory\TestFactory;
use App\Testing\Domain\Repository\TestRepositoryInterface;

class CreateTestCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TestRepositoryInterface $testRepository,
        private TestFactory $testFactory,
        private readonly AuthUserFetcherInterface $authUserFetcher
    ) {
    }

    /**
     * @return string Test ID
     */
    public function __invoke(CreateTestCommand $command): string
    {
        $creator = $this->authUserFetcher->getRequiredUser();
        $test = $this->testFactory->create(
            UserUlid::fromString($creator->getId()),
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
