<?php

namespace App\Skills\Domain\Repository;

use App\Shared\Domain\Entity\ValueObject\GlobalUserId;
use App\Skills\Domain\Entity\Specialist\Specialist;

interface SpecialistRepositoryInterface
{
    public function findOneByGlobalUserId(GlobalUserId $globalUserId): ?Specialist;

    public function add(Specialist $specialist): void;
}
