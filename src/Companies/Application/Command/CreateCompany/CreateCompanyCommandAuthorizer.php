<?php

declare(strict_types=1);

namespace App\Companies\Application\Command\CreateCompany;

use App\Auth\AccessControl\AccessManager\AccessMangerInterface;
use App\Auth\CQRSAuthorizer\Authorizer;
use App\Companies\Application\AccessControl\Action\CompanyAction;
use App\Companies\Domain\Entity\Company\Company;

class CreateCompanyCommandAuthorizer extends Authorizer
{
    public function __construct(
        private readonly AccessMangerInterface $accessManger
    ) {
    }

    /**
     * @param CreateCompanyCommand $command
     */
    public function permitted($command): bool
    {
        return $this->accessManger->isGranted(CompanyAction::CREATE, Company::class);
    }
}
