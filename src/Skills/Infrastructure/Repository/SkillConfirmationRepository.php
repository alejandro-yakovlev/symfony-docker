<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Entity\Specialist\SkillConfirmation;
use App\Skills\Domain\Repository\SkillConfirmationRepositoryInterface;

class SkillConfirmationRepository implements SkillConfirmationRepositoryInterface
{
    public function findBySpecialist(string $skillId, string $specialistId): ?SkillConfirmation
    {
        // TODO: Implement findBySpecialist() method.
    }

    public function add(?SkillConfirmation $skillConfirmation): void
    {
        // TODO: Implement add() method.
    }
}
