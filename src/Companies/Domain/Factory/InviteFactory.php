<?php

declare(strict_types=1);

namespace App\Companies\Domain\Factory;

use App\Companies\Domain\Entity\Employee\Employee;
use App\Companies\Domain\Entity\Employee\Invite;

class InviteFactory
{
    public function create(Employee $employee): Invite
    {
        return new Invite($employee);
    }
}
