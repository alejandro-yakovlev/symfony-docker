<?php

declare(strict_types=1);

namespace App\Companies\Application\Command\InviteEmployee;

use App\Auth\AccessControl\AccessManager\AccessMangerInterface;
use App\Auth\CQRSAuthorizer\Authorizer;
use App\Companies\Application\AccessControl\Action\EmployeeAction;
use App\Companies\Domain\Repository\EmployeeRepositoryInterface;
use App\Shared\Domain\Service\AssertService;

class InviteEmployeeCommandAuthorizer extends Authorizer
{
    public function __construct(
        private readonly EmployeeRepositoryInterface $employeeRepository,
        private readonly AccessMangerInterface $accessManger
    ) {
    }

    /**
     * @param InviteEmployeeCommand $command
     */
    public function permitted($command): bool
    {
        $employee = $this->employeeRepository->findById($command->employeeId);

        AssertService::notEmpty($employee, 'Сотрудник не найден');

        return $this->accessManger->isGranted(EmployeeAction::INVITE, $employee);
    }
}
