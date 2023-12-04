<?php

namespace App\Skills\Domain\Repository;

use App\Shared\Domain\Repository\PaginationResult;
use App\Skills\Domain\Aggregate\Speciality\Speciality;

interface SpecialityRepositoryInterface
{
    public function add(Speciality $entity): void;

    public function findOne(SpecialityFilter $filter): ?Speciality;

    public function findPagedItems(SpecialityFilter $filter): PaginationResult;
}
