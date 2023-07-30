<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\DeleteSpeciality;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;
use App\Skills\Domain\Service\SpecialityFetcher;

readonly class DeleteSpecialityCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SpecialityRepositoryInterface $specialityRepository,
        private SpecialityFetcher $specialityFetcher
    ) {
    }

    public function __invoke(DeleteSpecialityCommand $command): DeleteSpecialityCommandResult
    {
        $speciality = $this->specialityFetcher->getRequiredSpeciality($command->specialityId);
        $speciality->delete();
        $this->specialityRepository->add($speciality);

        return new DeleteSpecialityCommandResult();
    }
}
