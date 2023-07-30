<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\CreateSpeciality;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Skills\Domain\Factory\SpecialityFactory;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;

class CreateSpecialityCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserFetcherInterface $userFetcher,
        private readonly SpecialityFactory $specialityFactory,
        private readonly SpecialityRepositoryInterface $specialityRepository
    ) {
    }

    public function __invoke(CreateSpecialityCommand $command): CreateSpecialityCommandResult
    {
        $ownerId = $this->userFetcher->requiredUser()->getId();
        $speciality = $this->specialityFactory->create($command->name, $ownerId);
        $this->specialityRepository->add($speciality);

        return new CreateSpecialityCommandResult($speciality->getId());
    }
}
