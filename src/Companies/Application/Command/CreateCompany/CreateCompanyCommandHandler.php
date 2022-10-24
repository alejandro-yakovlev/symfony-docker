<?php

declare(strict_types=1);

namespace App\Companies\Application\Command\CreateCompany;

use App\Auth\AuthUserFetcher\AuthUserFetcherInterface;
use App\Companies\Application\DTO\CompanyDTO;
use App\Companies\Domain\Factory\CompanyFactory;
use App\Companies\Domain\Repository\CompanyRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateCompanyCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly CompanyRepositoryInterface $companyRepository,
        private readonly CompanyFactory $companyFactory,
        private readonly AuthUserFetcherInterface $userFetcher
    ) {
    }

    public function __invoke(CreateCompanyCommand $command): CreateCompanyCommandResult
    {
        $owner = $this->userFetcher->getRequiredUser();
        $company = $this->companyFactory->create(
            $owner->getId(),
            $command->name,
            $command->contactPerson
        );
        $this->companyRepository->add($company);

        return new CreateCompanyCommandResult(CompanyDTO::fromEntity($company));
    }
}
