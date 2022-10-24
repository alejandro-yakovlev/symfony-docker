<?php

declare(strict_types=1);

namespace App\Testing\Domain\Factory;

use App\Shared\Domain\Entity\ValueObject\UserUlid;
use App\Testing\Domain\Entity\Test\Test;
use App\Testing\Domain\Entity\TestingSession\TestingSession;

class TestingSessionFactory
{
    public function create(Test $test, string $userId): TestingSession
    {
        return new TestingSession($test, UserUlid::fromString($userId));
    }
}
