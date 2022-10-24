<?php

namespace App\Skills\Domain\Repository;

use App\Shared\Domain\Entity\ValueObject\UserUlid;
use App\Skills\Domain\Entity\Specialist\Specialist;

interface SpecialistRepositoryInterface
{
    public function findOneByUserId(UserUlid $userId): ?Specialist;

    public function add(Specialist $specialist): void;
}
