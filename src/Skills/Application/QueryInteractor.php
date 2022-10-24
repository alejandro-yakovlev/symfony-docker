<?php

declare(strict_types=1);

namespace App\Skills\Application;

use App\Shared\Application\Query\QueryBusInterface;
use App\Skills\Application\Query\FindSkill\FindSkillQuery;
use App\Skills\Application\Query\FindSkill\FindSkillQueryResult;
use App\Skills\Application\Query\FindSkillGroup\FindSkillGroupQuery;
use App\Skills\Application\Query\FindSkillGroup\FindSkillGroupQueryResult;
use App\Skills\Application\Query\FindSkillGroups\FindSkillGroupsQuery;
use App\Skills\Application\Query\FindSkillGroups\FindSkillGroupsQueryResult;
use App\Skills\Application\Query\FindSkills\FindSkillsQuery;
use App\Skills\Application\Query\FindSkills\FindSkillsQueryResult;

class QueryInteractor
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    public function findSkill(FindSkillQuery $query): FindSkillQueryResult
    {
        return $this->queryBus->execute($query);
    }

    public function findSkillGroup(FindSkillGroupQuery $query): FindSkillGroupQueryResult
    {
        return $this->queryBus->execute($query);
    }

    public function findSkillGroups(FindSkillGroupsQuery $query): FindSkillGroupsQueryResult
    {
        return $this->queryBus->execute($query);
    }

    public function findSkillsByIds(FindSkillsQuery $query): FindSkillsQueryResult
    {
        return $this->queryBus->execute($query);
    }
}
