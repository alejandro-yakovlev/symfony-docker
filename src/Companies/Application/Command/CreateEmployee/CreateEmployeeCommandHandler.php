<?php

declare(strict_types=1);

namespace App\Companies\Application\Command\CreateEmployee;

use App\Companies\Application\DTO\EmployeeDTO;
use App\Companies\Domain\Factory\EmployeeFactory;
use App\Companies\Domain\Repository\CompanyRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateEmployeeCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EmployeeFactory $employeeFactory,
        private readonly CompanyRepositoryInterface $companyRepository,
    ) {
    }

    public function __invoke(CreateEmployeeCommand $command): CreateEmployeeCommandResult
    {
        $company = $this->companyRepository->findById($command->companyId);

        $employee = $this->employeeFactory->createCandidate($command->contact, $company);
        $company->addEmployee($employee);

        $this->companyRepository->add($company);

        return new CreateEmployeeCommandResult(EmployeeDTO::fromEntity($employee));
    }
}
