<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Command\UpdateSpeciality;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Domain\Service\AssertService;
use App\Skills\Domain\Aggregate\Speciality\PublicationStatus;
use App\Skills\Domain\Aggregate\Speciality\Speciality;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;
use App\Skills\Domain\Service\SpecialityFetcher;

readonly class UpdateSpecialityCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserFetcherInterface $userFetcher,
        private SpecialityFetcher $specialityFetcher,
        private SpecialityRepositoryInterface $specialityRepository
    ) {
    }

    public function __invoke(UpdateSpecialityCommand $command): UpdateSpecialityCommandResult
    {
        $speciality = $this->specialityFetcher->getRequiredSpeciality($command->specialityId);
        AssertService::true(
            $speciality->isOwnedBy($this->userFetcher->requiredUser()->getId()),
            'Специальность не принадлежит пользователю'
        );

        if (!is_null($command->specialityDTO->name)) {
            $speciality->setName($command->specialityDTO->name);
        }

        if (!is_null($command->specialityDTO->description)) {
            $speciality->setDescription($command->specialityDTO->description);
        }

        $this->updatePublicationStatus($command, $speciality);

        $this->specialityRepository->add($speciality);

        return new UpdateSpecialityCommandResult();
    }

    public function updatePublicationStatus(
        UpdateSpecialityCommand $command,
        Speciality $speciality
    ): void {
        $publicationStatus = PublicationStatus::from($command->specialityDTO->publicationStatus);
        AssertService::true(
            $publicationStatus->isDraft() || $publicationStatus->isPublished(),
            'Неверный статус публикации'
        );

        if ($publicationStatus->isDraft()) {
            $speciality->draft();
        } elseif ($publicationStatus->isPublished()) {
            $speciality->publish();
        }
    }
}
