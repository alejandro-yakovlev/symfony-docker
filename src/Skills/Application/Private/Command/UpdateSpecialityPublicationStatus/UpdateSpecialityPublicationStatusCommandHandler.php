<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\UpdateSpecialityPublicationStatus;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Domain\Service\AssertService;
use App\Skills\Domain\Aggregate\Speciality\PublicationStatus;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;
use App\Skills\Domain\Service\SpecialityFetcher;

readonly class UpdateSpecialityPublicationStatusCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SpecialityFetcher $specialityFetcher,
        private UserFetcherInterface $userFetcher,
        private SpecialityRepositoryInterface $specialityRepository,
    ) {
    }

    public function __invoke(
        UpdateSpecialityPublicationStatusCommand $command
    ): UpdateSpecialityPublicationStatusCommandResult {
        $speciality = $this->specialityFetcher->getRequiredSpeciality($command->specialityId);

        AssertService::true(
            $speciality->isOwnedBy($this->userFetcher->requiredUser()->getId()),
            'Специальность не принадлежит пользователю'
        );

        $publicationStatus = PublicationStatus::from($command->publicationStatus);
        AssertService::true(
            $publicationStatus->isDraft() || $publicationStatus->isPublished(),
            'Неверный статус публикации'
        );

        if ($publicationStatus->isDraft()) {
            $speciality->draft();
        } elseif ($publicationStatus->isPublished()) {
            $speciality->publish();
        }

        $this->specialityRepository->add($speciality);

        return new UpdateSpecialityPublicationStatusCommandResult();
    }
}
