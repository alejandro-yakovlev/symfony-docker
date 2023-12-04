<?php

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Aggregate\Specialist\Specialist;

interface SpecialistRepositoryInterface
{
    public function findOneByPublicUserId(string $publicUserId): ?Specialist;

    public function add(Specialist $specialist): void;
}
