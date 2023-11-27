<?php

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Aggregate\SkillConfirmation\SkillConfirmation;

interface SkillConfirmationRepositoryInterface
{
    public function findOneBySpecialist(string $skillId, string $specialistId): ?SkillConfirmation;

    public function add(SkillConfirmation $skillConfirmation): void;
}
