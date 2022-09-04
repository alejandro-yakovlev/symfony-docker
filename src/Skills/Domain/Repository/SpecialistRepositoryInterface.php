<?php

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Entity\Specialist\Specialist;

interface SpecialistRepositoryInterface
{
    public function findOneByGlobalUserId(string $globalUserId): ?Specialist;

    public function add(Specialist $specialist): void;
}
