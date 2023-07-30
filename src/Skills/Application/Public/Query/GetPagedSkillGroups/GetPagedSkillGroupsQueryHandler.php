<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\GetPagedSkillGroups;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Repository\Pager;
use App\Skills\Application\Shared\DTO\SkillGroup\SkillGroupDTOTransformer;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;

class GetPagedSkillGroupsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly SkillGroupRepositoryInterface $skillGroupRepository,
        private readonly SkillGroupDTOTransformer $skillGroupDTOHydrator
    ) {
    }

    public function __invoke(GetPagedSkillGroupsQuery $query): GetPagedSkillGroupsQueryResult
    {
        $paginator = $this->skillGroupRepository->findByFilter($query->filter);
        $skillGroups = $this->skillGroupDTOHydrator->fromEntityList($paginator->items);
        $pager = new Pager(
            $query->filter->pager->page,
            $query->filter->pager->perPage,
            $paginator->total
        );

        return new GetPagedSkillGroupsQueryResult($skillGroups, $pager);
    }
}
