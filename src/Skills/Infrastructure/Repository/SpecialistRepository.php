<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Entity\Specialist\Specialist;
use App\Skills\Domain\Repository\SpecialistRepositoryInterface;

class SpecialistRepository implements SpecialistRepositoryInterface
{
    public function findByGlobalUserId(string $globalUserId): ?Specialist
    {
        // TODO: Implement findByGlobalUserId() method.
    }

    public function add(Specialist $specialist): void
    {
        // TODO: Implement add() method.
    }
}
