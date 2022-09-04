<?php

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Entity\Speciality\Speciality;

interface SpecialityRepositoryInterface
{
    public function findOneByName(string $getName): ?Speciality;
}
