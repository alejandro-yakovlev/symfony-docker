<?php

declare(strict_types=1);

namespace App\Companies\Application\Command\CreateCompany;

use App\Companies\Application\DTO\CompanyDTO;

class CreateCompanyCommandResult
{
    public function __construct(public readonly CompanyDTO $company)
    {
    }
}
