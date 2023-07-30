<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\GetPagedSpecialities;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Repository\Pager;
use App\Skills\Application\Shared\DTO\Speciality\SpecialityDTOTransformer;
use App\Skills\Domain\Aggregate\Speciality\PublicationStatus;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;

readonly class GetPagedSpecialitiesQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private SpecialityRepositoryInterface $specialityRepository,
        private SpecialityDTOTransformer $specialityDTOHydrator
    ) {
    }

    public function __invoke(GetPagedSpecialitiesQuery $query): GetPagedSpecialitiesQueryResult
    {
        // В публичном доступе только опубликованные специальности
        $query->filter->publicationStatuses = [
            PublicationStatus::PUBLISHED->value,
        ];

        $pagination = $this->specialityRepository->findPagedItems($query->filter);
        $specialities = $this->specialityDTOHydrator->fromEntities($pagination->items);

        return new GetPagedSpecialitiesQueryResult(
            $specialities,
            new Pager(
                $query->filter->pager->page,
                $query->filter->pager->perPage,
                $pagination->total
            )
        );
    }
}
