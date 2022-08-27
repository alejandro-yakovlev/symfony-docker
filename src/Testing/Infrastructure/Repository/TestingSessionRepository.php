<?php

namespace App\Testing\Infrastructure\Repository;

use App\Testing\Domain\Entity\TestingSession\TestingSession;
use App\Testing\Domain\Repository\TestingSessionRepositoryInterface;

class TestingSessionRepository implements TestingSessionRepositoryInterface
{
    public function findById(string $id): ?TestingSession
    {
        // TODO: Implement findById() method.
    }
}
