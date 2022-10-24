<?php

declare(strict_types=1);

namespace App\Companies\Application\Command;

use App\Companies\Application\Command\CreateCompany\CreateCompanyCommand;
use App\Companies\Application\Command\CreateCompany\CreateCompanyCommandResult;
use App\Companies\Application\Command\CreateEmployee\CreateEmployeeCommand;
use App\Companies\Application\Command\CreateEmployee\CreateEmployeeCommandResult;
use App\Companies\Application\Command\InviteEmployee\InviteEmployeeCommand;
use App\Companies\Application\Command\InviteEmployee\InviteEmployeeCommandResult;
use App\Shared\Application\Command\CommandBusInterface;

class CommandInteractor
{
    public function __construct(private readonly CommandBusInterface $commandBus)
    {
    }

    public function inviteEmployee(InviteEmployeeCommand $command): InviteEmployeeCommandResult
    {
        return $this->commandBus->execute($command);
    }

    public function createCompany(CreateCompanyCommand $command): CreateCompanyCommandResult
    {
        return $this->commandBus->execute($command);
    }

    public function createEmployee(CreateEmployeeCommand $command): CreateEmployeeCommandResult
    {
        return $this->commandBus->execute($command);
    }
}
