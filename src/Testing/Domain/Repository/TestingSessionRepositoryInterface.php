<?php

namespace App\Testing\Domain\Repository;

use App\Testing\Domain\Aggregate\TestingSession\TestingSession;

interface TestingSessionRepositoryInterface
{
    public function add(TestingSession $testingSession): void;

    public function findById(string $id): ?TestingSession;
}
