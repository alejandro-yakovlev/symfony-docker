<?php

declare(strict_types=1);

namespace App\Companies\Domain\Repository;

use App\Companies\Domain\Entity\Employee\Invite;

interface InviteRepositoryInterface
{
    public function add(Invite $entity): void;

    public function findOneByEmployee(string $employeeId): ?Invite;
}
