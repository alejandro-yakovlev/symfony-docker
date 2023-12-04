<?php

namespace App\Skills\Domain\Aggregate\SkillConfirmation;

use App\Shared\Domain\Aggregate\Id;

/**
 * Доказательство подтверждения навыка.
 */
class Proof
{
    private string $id;

    private string $testId;

    private SkillConfirmation $skillConfirmation;

    public function __construct(string $testId, SkillConfirmation $skillConfirmation)
    {
        $this->id = Id::makeUlid();
        $this->testId = $testId;
        $this->skillConfirmation = $skillConfirmation;
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
