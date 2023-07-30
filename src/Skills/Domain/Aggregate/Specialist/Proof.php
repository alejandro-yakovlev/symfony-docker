<?php

namespace App\Skills\Domain\Aggregate\Specialist;

use App\Shared\Domain\Aggregate\Id;

/**
 * Доказательство подтверждения навыка.
 */
class Proof
{
    private string $id;

    private string $testId;

    public function __construct(string $testId)
    {
        $this->id = Id::makeUlid();
        $this->testId = $testId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTestId(): string
    {
        return $this->testId;
    }
}
