<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\FindSpeciality;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\DTO\Speciality\SpecialityDTOTransformer;
use App\Skills\Domain\Aggregate\Speciality\PublicationStatus;
use App\Skills\Domain\Repository\SpecialityFilter;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;

readonly class FindSpecialityQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private SpecialityRepositoryInterface $specialityRepository,
        private SpecialityDTOTransformer $specialityDTOTransformer
    ) {
    }

    public function __invoke(FindSpecialityQuery $query): FindSpecialityQueryResult
    {
        $speciality = $this->specialityRepository->findOne(
            new SpecialityFilter(
                publicationStatuses: [PublicationStatus::PUBLISHED->value],
                id: $query->id
            )
        );

        if (!$speciality) {
            return new FindSpecialityQueryResult(null);
        }

        $specialityDTO = $this->specialityDTOTransformer->fromEntity($speciality);

        return new FindSpecialityQueryResult($specialityDTO);
    }
}
