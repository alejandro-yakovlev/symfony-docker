<?php

declare(strict_types=1);

namespace App\Skills\Application\Private;

use App\Shared\Application\Query\QueryBusInterface;
use App\Skills\Application\Private\Query\FindMySpeciality\FindMySpecialityQuery;
use App\Skills\Application\Private\Query\FindMySpeciality\FindMySpecialityQueryResult;
use App\Skills\Application\Private\Query\GetMyPagedSpecialities\GetMyPagedSpecialitiesQuery;
use App\Skills\Application\Private\Query\GetMyPagedSpecialities\GetMyPagedSpecialitiesQueryResult;
use App\Skills\Application\Public\Query\FindSkill\FindSkillQuery;
use App\Skills\Application\Public\Query\FindSkill\FindSkillQueryResult;
use App\Skills\Application\Public\Query\FindSkillGroup\FindSkillGroupQuery;
use App\Skills\Application\Public\Query\FindSkillGroup\FindSkillGroupQueryResult;
use App\Skills\Application\Public\Query\FindSpeciality\FindSpecialityQuery;
use App\Skills\Application\Public\Query\FindSpeciality\FindSpecialityQueryResult;
use App\Skills\Application\Public\Query\FindSpecialitySkill\FindSpecialitySkillQuery;
use App\Skills\Application\Public\Query\FindSpecialitySkill\FindSpecialitySkillQueryResult;
use App\Skills\Application\Public\Query\GetPagedSkillGroups\GetPagedSkillGroupsQuery;
use App\Skills\Application\Public\Query\GetPagedSkillGroups\GetPagedSkillGroupsQueryResult;
use App\Skills\Application\Public\Query\GetPagedSkills\GetPagedSkillsQuery;
use App\Skills\Application\Public\Query\GetPagedSkills\GetPagedSkillsQueryResult;
use App\Skills\Application\Public\Query\GetPagedSpecialities\GetPagedSpecialitiesQuery;
use App\Skills\Application\Public\Query\GetPagedSpecialities\GetPagedSpecialitiesQueryResult;
use App\Skills\Domain\Repository\SpecialityFilter;

readonly class PrivateQueryInteractor
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function findSkill(string $id): FindSkillQueryResult
    {
        $query = new FindSkillQuery($id);

        return $this->queryBus->execute($query);
    }

    public function findSkillGroup(string $id): FindSkillGroupQueryResult
    {
        $query = new FindSkillGroupQuery($id);

        return $this->queryBus->execute($query);
    }

    /**
     * @deprecated
     */
    public function getPagedSkillGroups(GetPagedSkillGroupsQuery $query): GetPagedSkillGroupsQueryResult
    {
        return $this->queryBus->execute($query);
    }

    /**
     * @deprecated
     */
    public function getPagedSkills(GetPagedSkillsQuery $query): GetPagedSkillsQueryResult
    {
        return $this->queryBus->execute($query);
    }

    public function findSpeciality(string $specialityId): FindSpecialityQueryResult
    {
        $query = new FindSpecialityQuery($specialityId);

        return $this->queryBus->execute($query);
    }

    public function findMySpeciality(string $id): FindMySpecialityQueryResult
    {
        $query = new FindMySpecialityQuery($id);

        return $this->queryBus->execute($query);
    }

    public function findSpecialitySkill(string $specialitySkillId): FindSpecialitySkillQueryResult
    {
        $query = new FindSpecialitySkillQuery($specialitySkillId);

        return $this->queryBus->execute($query);
    }

    /**
     * @deprecated
     */
    public function getPagedSpecialities(GetPagedSpecialitiesQuery $query): GetPagedSpecialitiesQueryResult
    {
        return $this->queryBus->execute($query);
    }

    public function getMyPagedSpecialities(SpecialityFilter $filter): GetMyPagedSpecialitiesQueryResult
    {
        $query = new GetMyPagedSpecialitiesQuery($filter);

        return $this->queryBus->execute($query);
    }
}
