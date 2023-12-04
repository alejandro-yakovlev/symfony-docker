<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase;

use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Domain\Repository\Pager;
use App\Skills\Application\UseCase\Query\GetPagedSkillGroups\GetPagedSkillGroupsQuery;
use App\Skills\Application\UseCase\Query\GetPagedSkillGroups\GetPagedSkillGroupsQueryResult;
use App\Skills\Application\UseCase\Query\GetPagedSkills\GetPagedSkillsQuery;
use App\Skills\Application\UseCase\Query\GetPagedSkills\GetPagedSkillsQueryResult;
use App\Skills\Application\UseCase\Query\GetPagedSpecialities\GetPagedSpecialitiesQuery;
use App\Skills\Application\UseCase\Query\GetPagedSpecialities\GetPagedSpecialitiesQueryResult;
use App\Skills\Domain\Repository\SkillGroupsFilter;
use App\Skills\Domain\Repository\SpecialityFilter;

readonly class PublicUseCaseInteractor
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function getPagedSkills(Pager $pager): GetPagedSkillsQueryResult
    {
        $query = new GetPagedSkillsQuery($pager);

        return $this->queryBus->execute($query);
    }

    public function getPagedSkillGroups(SkillGroupsFilter $filter): GetPagedSkillGroupsQueryResult
    {
        $query = new GetPagedSkillGroupsQuery($filter);

        return $this->queryBus->execute($query);
    }

    public function getPagedSpecialities(SpecialityFilter $filter): GetPagedSpecialitiesQueryResult
    {
        $query = new GetPagedSpecialitiesQuery($filter);

        return $this->queryBus->execute($query);
    }
}
