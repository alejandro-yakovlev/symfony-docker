<?php

declare(strict_types=1);

namespace App\Testing\Domain\Service;

use App\Testing\Domain\Aggregate\TestingSession\TestingSession;
use App\Testing\Domain\Factory\TestingSessionFactory;
use App\Testing\Domain\Repository\TestingSessionRepositoryInterface;
use App\Testing\Domain\Repository\TestRepositoryInterface;

readonly class TestingSessionMaker
{
    public function __construct(
        private TestingSessionRepositoryInterface $testingSessionRepository,
        private TestingSessionFactory $testingSessionFactory,
        private TestRepositoryInterface $testRepository,
    ) {
    }

    public function make(string $testId, string $userId): TestingSession
    {
        $test = $this->testRepository->findOneById($testId);
        $entity = $this->testingSessionFactory->create($test, $userId);
        $this->testingSessionRepository->add($entity);

        return $entity;
    }
}
