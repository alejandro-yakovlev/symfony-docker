<?php

declare(strict_types=1);

namespace App\Companies\Application\Command\CreateEmployee;

use App\Auth\AccessControl\AccessManager\AccessMangerInterface;
use App\Auth\CQRSAuthorizer\Authorizer;
use App\Companies\Application\AccessControl\Action\CompanyAction;
use App\Companies\Domain\Repository\CompanyRepositoryInterface;
use App\Shared\Domain\Service\AssertService;

class CreateEmployeeCommandAuthorizer extends Authorizer
{
    public function __construct(
        private readonly CompanyRepositoryInterface $companyRepository,
        private readonly AccessMangerInterface $accessManger
    ) {
    }

    /**
     * @param CreateEmployeeCommand $command
     */
    public function permitted($command): bool
    {
        $company = $this->companyRepository->findById($command->companyId);
        AssertService::notEmpty($company, 'Компания не найдена');

        return $this->accessManger->isGranted(CompanyAction::CREATE_EMPLOYEE, $company);
    }
}
