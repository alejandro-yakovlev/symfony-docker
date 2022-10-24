<?php

declare(strict_types=1);

namespace App\Companies\Domain\Service;

use App\Companies\Domain\Entity\Employee\Invite;
use App\Companies\Domain\Factory\InviteFactory;
use App\Companies\Domain\Repository\EmployeeRepositoryInterface;
use App\Companies\Domain\Repository\InviteRepositoryInterface;

class InviterService
{
    public function __construct(
        private readonly EmployeeRepositoryInterface $employeeRepository,
        private readonly InviteRepositoryInterface $inviteRepository,
        private readonly InviteFactory $inviteFactory
    ) {
    }

    public function makeInvite($employeeId): Invite
    {
        $employee = $this->employeeRepository->findById($employeeId);

        $invite = $employee->getInvite();
        if (!$invite) {
            $invite = $this->inviteFactory->create($employee);
            $this->inviteRepository->add($invite);
        }

        return $invite;
    }
}
