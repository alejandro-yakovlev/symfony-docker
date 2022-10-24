<?php

declare(strict_types=1);

namespace App\Companies\Domain\Repository;

use App\Companies\Domain\Entity\Employee\Employee;

interface EmployeeRepositoryInterface
{
    public function add(Employee $entity): void;

    public function findById(string $id): ?Employee;
}
