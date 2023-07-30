<?php

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Aggregate\Specialist\Specialist;

interface SpecialistRepositoryInterface
{
    public function findOneByUser(string $userId): ?Specialist;

    public function add(Specialist $specialist): void;
}
