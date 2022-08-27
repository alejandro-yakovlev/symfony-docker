<?php

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Entity\Specialist\Specialist;

interface SpecialistRepositoryInterface
{
    public function findByGlobalUserId(string $globalUserId): ?Specialist;

    public function add(Specialist $specialist): void;
}
