<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Query\GetMyPagedSpecialities;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Repository\Pager;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Skills\Application\Shared\DTO\Speciality\SpecialityDTOTransformer;
use App\Skills\Domain\Aggregate\Speciality\PublicationStatus;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;

readonly class GetMyPagedSpecialitiesQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private SpecialityRepositoryInterface $specialityRepository,
        private SpecialityDTOTransformer $specialityDTOHydrator,
        private UserFetcherInterface $userFetcher
    ) {
    }

    public function __invoke(GetMyPagedSpecialitiesQuery $query): GetMyPagedSpecialitiesQueryResult
    {
        // Доступны только созданные текущим пользователем специальности
        $query->filter->ownerId = $this->userFetcher->requiredUser()->getId();

        // Доступны только опубликованные специальности и черновики
        $query->filter->publicationStatuses = [
            PublicationStatus::PUBLISHED->value,
            PublicationStatus::DRAFT->value,
        ];

        $pagination = $this->specialityRepository->findPagedItems($query->filter);
        $specialities = $this->specialityDTOHydrator->fromEntities($pagination->items);

        return new GetMyPagedSpecialitiesQueryResult(
            $specialities,
            new Pager(
                $query->filter->pager->page,
                $query->filter->pager->perPage,
                $pagination->total
            )
        );
    }
}
