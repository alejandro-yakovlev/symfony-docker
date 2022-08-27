<?php

namespace App\Testing\Domain\Repository;

use App\Testing\Domain\Entity\TestingSession\TestingSession;

interface TestingSessionRepositoryInterface
{
    public function findById(string $id): ?TestingSession;
}
