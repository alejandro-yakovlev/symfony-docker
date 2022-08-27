<?php

namespace App\Testing\Application\Query\FindTestingSession;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Testing\Application\Query\DTO\TestingSessionDTO;
use App\Testing\Domain\Repository\TestingSessionRepositoryInterface;

class FindTestingSessionQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly TestingSessionRepositoryInterface $testingSessionRepository)
    {
    }

    public function __invoke(FindTestingSessionQuery $query)
    {
        $testingSession = $this->testingSessionRepository->findById($query->testingSessionId);

        if ($testingSession) {
            return TestingSessionDTO::fromEntity($testingSession);
        }

        return null;
    }
}
