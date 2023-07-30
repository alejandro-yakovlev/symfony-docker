<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Query\FindMySpeciality;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\Shared\DTO\Speciality\SpecialityDTOTransformer;
use App\Skills\Domain\Aggregate\Speciality\PublicationStatus;
use App\Skills\Domain\Repository\SpecialityFilter;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;

readonly class FindMySpecialityQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private SpecialityRepositoryInterface $specialityRepository,
        private SpecialityDTOTransformer $specialityDTOTransformer
    ) {
    }

    public function __invoke(FindMySpecialityQuery $query): FindMySpecialityQueryResult
    {
        $speciality = $this->specialityRepository->findOne(
            new SpecialityFilter(
                publicationStatuses: [
                    PublicationStatus::PUBLISHED->value,
                    PublicationStatus::DRAFT->value,
                ],
                id: $query->id
            )
        );

        if (!$speciality) {
            return new FindMySpecialityQueryResult(null);
        }

        $specialityDTO = $this->specialityDTOTransformer->fromEntity($speciality);

        return new FindMySpecialityQueryResult($specialityDTO);
    }
}
