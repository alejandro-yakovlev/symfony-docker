<?php

declare(strict_types=1);

namespace App\Testing\Domain\Factory;

use App\Testing\Domain\Aggregate\Test\Test;
use App\Testing\Domain\Aggregate\TestingSession\TestingSession;

class TestingSessionFactory
{
    public function create(Test $test, string $userId): TestingSession
    {
        return new TestingSession($test, $userId);
    }
}
