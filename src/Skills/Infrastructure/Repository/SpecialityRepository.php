<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Entity\Speciality\Speciality;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;

class SpecialityRepository implements SpecialityRepositoryInterface
{
    public function findByName(string $getName): ?Speciality
    {
        // TODO: Implement findByName() method.
    }
}
