<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\CreateSpeciality;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Skills\Domain\Service\SpecialityMaker;

readonly class CreateSpecialityCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserFetcherInterface $userFetcher,
        private SpecialityMaker $specialityMaker
    ) {
    }

    public function __invoke(CreateSpecialityCommand $command): CreateSpecialityCommandResult
    {
        $ownerId = $this->userFetcher->requiredUser()->getId();
        $speciality = $this->specialityMaker->make($command->name, $ownerId);

        return new CreateSpecialityCommandResult($speciality->getId());
    }
}
